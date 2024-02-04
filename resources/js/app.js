(function(){
  "use strict";
  $(document).on('change', '.datatable-filter [data-filter="select"]', function() {
    window.renderedDataTable.ajax.reload(null, false)
  })

  $(document).on('input', '.dt-search', function() {
    window.renderedDataTable.ajax.reload(null, false)
  })

  const confirmSwal = async (message) => {
    return await Swal.fire({
      title: message,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#858482',
      confirmButtonText: 'Yes, do it!',
      showClass: {
        popup: 'animate__animated animate__zoomIn'
      },
      hideClass: {
        popup: 'animate__animated animate__zoomOut'
      }
    }).then((result) => {
      return result
    })
  }

  window.confirmSwal = confirmSwal

  $('#quick-action-form').on('submit', function(e) {
    e.preventDefault()
    const form = $(this)
    const url = form.attr('action')
    const message = $('[name="message_'+$('[name="action_type"]').val()+'"]').val()
    const rowdIds = $("#datatable_wrapper .select-table-row:checked").map(function() {
        return $(this).val();
    }).get();
    confirmSwal(message).then((result) => {
      if(!result.isConfirmed) return
      callActionAjax({url: `${url}?rowIds=${rowdIds}`,body: form.serialize()})
      //
    })
  })

  // Update status on switch
  $(document).on('change', '#datatable_wrapper .switch-status-change', function() {
    let url = $(this).attr('data-url')
    let body = {
      status: $(this).prop('checked') ? 1 : 0,
      _token: $(this).attr('data-token')
    }
    callActionAjax({url: url, body: body})
  })

  $(document).on('change', '#datatable_wrapper .change-select', function() {
    let url = $(this).attr('data-url')
    let body = {
      value: $(this).val(),
      _token: $(this).attr('data-token')
    }
    callActionAjax({url: url, body: body})
  })

  function callActionAjax ({url, body}) {
    $.ajax({
      type: 'POST',
      url: url,
      data: body,
      success: function(res) {
        if (res.status) {
          window.successSnackbar(res.message)
          window.renderedDataTable.ajax.reload(resetActionButtons, false)
          const event = new CustomEvent('update_quick_action', {detail: {value: true}})
          document.dispatchEvent(event)
        } else {
          Swal.fire({
            title: 'Error',
            text: res.message,
            icon: "error",
            showClass: {
              popup: 'animate__animated animate__zoomIn'
            },
            hideClass: {
              popup: 'animate__animated animate__zoomOut'
            }
          })
          // window.errorSnackbar(res.message)
        }
      }
    })
  }

  // Update status on button click
  $(document).on('click', '#datatable_wrapper .button-status-change', function() {

    let url = $(this).attr('data-url')
    let body = {
      status: 1,
      _token: $(this).attr('data-token')
    }
    callActionAjax({url: url, body: body})
  })

  function callActionAjax ({url, body}) {
    $.ajax({
      type: 'POST',
      url: url,
      data: body,
      success: function(res) {
        if (res.status) {
          window.successSnackbar(res.message)
          window.renderedDataTable.ajax.reload(resetActionButtons, false)
          const event = new CustomEvent('update_quick_action', {detail: {value: true}})
          document.dispatchEvent(event)
        } else {
          window.errorSnackbar(res.message)
        }
      }
    })
  }

  //select row in datatable
  const dataTableRowCheck = (id) => {
    checkRow();
    if ($(".select-table-row:checked").length > 0) {
        $("#quick-action-form").removeClass('form-disabled');
        //if at-least one row is selected
        document.getElementById("select-all-table").indeterminate = true;
        $("#quick-actions").find("input, textarea, button, select").removeAttr("disabled");
    } else {
        //if no row is selected
        document.getElementById("select-all-table").indeterminate = false;
        $("#select-all-table").attr("checked", false);
        resetActionButtons();
    }

    if ($("#datatable-row-" + id).is(":checked")) {
        $("#row-" + id).addClass("table-active");
    } else {
        $("#row-" + id).removeClass("table-active");
    }

  };
  window.dataTableRowCheck = dataTableRowCheck

  const selectAllTable = (source) => {
    const checkboxes = document.getElementsByName("datatable_ids[]");
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        // if disabled property is given to checkbox, it won't select particular checkbox.
        if (!$("#" + checkboxes[i].id).prop('disabled')){
            checkboxes[i].checked = source.checked;
        }
        if ($("#" + checkboxes[i].id).is(":checked")) {
            $("#" + checkboxes[i].id)
                .closest("tr")
                .addClass("table-active");
            $("#quick-actions")
                .find("input, textarea, button, select")
                .removeAttr("disabled");
            if ($("#quick-action-type").val() == "") {
                $("#quick-action-apply").attr("disabled", true);
              }
        } else {
            $("#" + checkboxes[i].id)
                .closest("tr")
                .removeClass("table-active");
            resetActionButtons();
        }
    }

    checkRow();
};


  window.selectAllTable = selectAllTable

  const checkRow = () => {
    if ($(".select-table-row:checked").length > 0) {
      $("#quick-action-form").removeClass('form-disabled');
      $("#quick-action-apply").removeClass("btn-gray").addClass("btn-primary");
    } else {
      $("#quick-action-form").addClass('form-disabled');
      $("#quick-action-apply").removeClass("btn-primary").addClass("btn-gray");
    }
  }

  window.checkRow = checkRow

  //reset table action form elements
  const resetActionButtons = () => {
    checkRow()
    if(document.getElementById("select-all-table") !== undefined && document.getElementById("select-all-table") !== null) {
      document.getElementById("select-all-table").checked = false;
      $("#quick-action-form")[0].reset();
      $("#quick-actions")
          .find("input, textarea, button, select")
          .attr("disabled", "disabled");
      $("#quick-action-form").find("select").select2("destroy").select2().val(null).trigger("change")
    }
  };

  window.resetActionButtons = resetActionButtons

  const initDatatable = ({url, finalColumns, advanceFilter, drawCallback = undefined, orderColumn}) => {


    const data_table_limit = $('meta[name="data_table_limit"]').attr('content');


     // console.log("test",advanceFilter);
    window.renderedDataTable = $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: false,
      responsive: true,
      fixedHeader: true,
      lengthMenu: [
        [5, 10, 15, 20, 25, 100, -1],
        [5, 10, 15, 20, 25, 100, 'All'],
      ],
      order: orderColumn,
      pageLength : data_table_limit,
      dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
      ajax: {
        "type"   : "GET",
        "url"    : url,
        "data"   : function( d ) {
          d.search = {
            value: $('.dt-search').val()
          };
          d.filter = {
            column_status: $('#column_status').val()
          }
          if(typeof advanceFilter == 'function' && advanceFilter() !== undefined) {
            d.filter = {...d.filter,...advanceFilter()}
          }
        },
      },

      drawCallback: function() {
          if(laravel !== undefined) {
              window.laravel.initialize();
          }
          $('.select2').select2();
          if(drawCallback !== undefined && typeof drawCallback == 'function') {
            drawCallback()
          }
      },
      columns: finalColumns,
     });
  }

  window.initDatatable = initDatatable

  function formatCurrency(number, noOfDecimal, decimalSeparator, thousandSeparator, currencyPosition, currencySymbol) {
    // Convert the number to a string with the desired decimal places
    let formattedNumber = number.toFixed(noOfDecimal)

    // Split the number into integer and decimal parts
    let [integerPart, decimalPart] = formattedNumber.split('.')

    // Add thousand separators to the integer part
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousandSeparator)

    // Set decimalPart to an empty string if it is undefined
    decimalPart = decimalPart || ''

    // Construct the final formatted currency string
    let currencyString = ''

    if (currencyPosition === 'left' || currencyPosition === 'left_with_space') {
      currencyString += currencySymbol
      if (currencyPosition === 'left_with_space') {
        currencyString += ' '
      }
      currencyString += integerPart
      // Add decimal part and decimal separator if applicable
      if (noOfDecimal > 0) {
        currencyString += decimalSeparator + decimalPart
      }
    }

    if (currencyPosition === 'right' || currencyPosition === 'right_with_space') {
      // Add decimal part and decimal separator if applicable
      if (noOfDecimal > 0) {
        currencyString += integerPart + decimalSeparator + decimalPart
      }
      if (currencyPosition === 'right_with_space') {
        currencyString += ' '
      }
      currencyString += currencySymbol
    }

    return currencyString
  }

  window.formatCurrency = formatCurrency

})()
