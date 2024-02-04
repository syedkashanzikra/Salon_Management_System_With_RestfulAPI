<template>
  <form>
    <div :class="`offcanvas offcanvas-end`" data-bs-scroll="true" tabindex="-1" id="booking-form" aria-labelledby="offcanvasBookingForm">
      <template v-if="SINLGE_STEP == 'MAIN' && status == 'completed'">
        <InvoiceComponent :booking_id="id"></InvoiceComponent>
      </template>
      <template v-else-if="SINLGE_STEP == 'MAIN' && status != 'checkout'">
        <div class="offcanvas-header">
          <BookingHeader :booking_id="id" :status="status" :is_paid="is_paid" @statusUpdate="updateStatus"></BookingHeader>
        </div>
        <BookingStatus v-if="id" :status="status" :booking_id="id" :status-list="statusList" :employee_id="employee_id" @statusUpdate="updateStatus"></BookingStatus>
        <div>
          <div class="d-flex text-center date-time">
            <div class="col-6 py-3">
              <i>On</i> <strong v-if="start_date_time && start_date_time !== 'Invalid date'">{{ moment(start_date_time).format('D, MMM YYYY') }}</strong>
              <strong v-else> {{ moment(current_date).format('D, MMM YYYY') }}</strong>
            </div>
            <div class="col-6 py-3">
              <i>At</i> <strong v-if="start_date_time && start_date_time !== 'Invalid date'">{{ moment(start_date_time).format('LT') }}</strong>
              <strong v-else>--:--</strong>
            </div>
          </div>
        </div>
        <div class="offcanvas-body border-top">
          <div class="form-group" v-if="bookingType !== 'CALENDER_BOOKING' && branch.options.length > 1">
            <Multiselect id="branch_id" placeholder="Select Branch" v-model="branch_id" :disabled="is_paid || filterStatus(status).is_disabled" :value="branch_id" v-bind="singleSelectOption" :options="branch.options" @select="branchSelect" @change="removeBranch" class="form-group"></Multiselect>
          </div>
          <div class="form-group" v-if="bookingType !== 'CALENDER_BOOKING' && branch_id">
            <Multiselect id="employee_id" placeholder="Select Staff" v-model="employee_id" :value="employee_id" :disabled="is_paid || filterStatus(status).is_disabled" v-bind="singleSelectOption" :options="employee.options" @select="employeeSelect" @change="removeEmployee" class="form-group"></Multiselect>
          </div>
          <div class="row">
            <div class="form-group col-6" v-if="bookingType !== 'CALENDER_BOOKING' && employee_id">
              <div class="booking-datepicker">
                <flat-pickr v-model="current_date" :disabled="is_paid || filterStatus(status).is_disabled" placeholder="Select Date" @change="dateChange" :config="config" class="form-control" />
              </div>
            </div>
            <div class="form-group col-6" v-if="bookingType !== 'CALENDER_BOOKING' && current_date && employee_id">
              <Multiselect id="star_time" placeholder="Select Time" v-model="start_date_time" :disabled="is_paid || filterStatus(status).is_disabled" :value="start_date_time" v-bind="singleSelectOption" :options="slots" @select="slotSelect"  @change="removeSlot" class="form-group"></Multiselect>
            </div>
          </div>
          <div class="form-group border-bottom ">
            <!-- data-bs-toggle="modal" data-bs-target="#exampleModal" -->
            <div v-if="selectedCustomer">
              <div class="d-flex align-items-start gap-3 mb-2">
                <img :src="selectedCustomer.profile_image" alt="avatar" class="img-fluid avatar avatar-60 rounded-pill" />
                <div class="flex-grow-1">
                  <div class="gap-2">
                    <strong>{{ selectedCustomer.full_name }}</strong>
                    <p class="m-0">
                      <small>Client since {{ moment(selectedCustomer.created_at).format('MMMM YYYY') }}</small>
                    </p>
                  </div>
                </div>
                <button type="button" v-if="status !== 'check_in' && !is_paid" @click="removeCustomer()" class="btn btn-sm text-danger"><i class="fa-regular fa-trash-can"></i></button>
              </div>
              <div class="row">
                <label class="col-3"><i>{{ $t('booking.lbl_phone') }}</i></label>
                <strong class="col">{{ selectedCustomer.mobile }}</strong>
              </div>
              <div class="row mb-3" >
                <label class="col-3"><i>{{ $t('booking.lbl_e-mail') }}</i></label>
                <strong class="col">{{ selectedCustomer.email }}</strong>
              </div>
            </div>
            <Multiselect id="user_id" v-else v-model="user_id" placeholder="Select Customer" :disabled="is_paid || filterStatus(status).is_disabled" :value="user_id" v-bind="singleSelectOption" :options="customer.options" @select="customerSelect" class="form-group"></Multiselect>
          </div>
          <ul class="form-group list-group list-group-flush">
            <li v-for="(service, index) in selectedService" :key="index" class="list-group-item py-3 px-1">
              <div class="d-flex flex-column gap-2">
                <div class="d-flex align-items-center justify-content-between">
                  <h6>{{ service.service_name }} ({{ formatCurrencyVue(service.service_price) }})</h6>
                  <button type="button" v-if="status !== 'check_in' && !is_paid" @click="removeService(service.service_id)" class="btn btn-sm text-danger"><i class="fa-regular fa-trash-can"></i></button>
                </div>
                <p class="m-0">
                  <label><i>{{ $t('booking.lbl_with') }}</i></label> <strong>{{ service.employee?.full_name || selectedEmployee?.name || '' }}</strong>
                </p>
                <div>
                  <label><i>{{ $t('booking.lbl_at') }}</i></label> <strong v-if="service.start_date_time !== 'Invalid date'">{{ moment(service.start_date_time).format('LT') }}</strong><strong v-else>--:--</strong> <span class="px-2">|</span> <label class="me-2"><i>For: </i></label><strong>{{ service.duration_min }} Min</strong>
                </div>
              </div>
            </li>
          </ul>
          <div v-if="services_id.length < service.options.length && selectedCustomer && employee_id" class="text-center">
            <Multiselect v-if="newService" :canClear="false" placeholder="Select Service" ref="serviceInput" class="" v-model="services_id" :value="services_id" v-bind="multipleSelectOption" :options="service.options" @select="serviceSelect" id="service_ids">
              <template v-slot:multiplelabel="{ values }">
                <div class="multiselect-multiple-label">Select Service</div>
              </template>
            </Multiselect>
            <template v-else>
              <a v-if="!filterStatus(status).is_disabled && !is_paid && start_date_time" href="javascript:void(0)" @click="addNewService" class="btnw-100"><i class="fa-solid fa-circle-plus"></i>  {{ $t('booking.lbl_add_service') }}</a>
            </template>
          </div>
        </div>
        <div class="offcanvas-footer">
          <div class="form-group px-3">
            <label class="form-label">{{ $t('booking.lbl_note') }}</label>
            <textarea name="note" :disabled="is_paid || filterStatus(status).is_disabled" v-model="note" cols="60" class="form-control"></textarea>
          </div>
          <div class="form-group m-0 p-3 d-flex justify-content-between border-top">
            <label for=""><strong>{{ $t('booking.lbl_sub_tot') }} </strong> </label>
            <span>{{ formatCurrencyVue(SUB_TOTAL_SERVICE_AMOUNT) }}</span>
          </div>
          <div class="d-grid gap-3" v-if="status !== 'check_in' && !is_paid">
            <button :disabled="services_id.length > 0 && status !== 'cancelled' ? false : true" :class="`btn ${services_id.length > 0 && status !== 'cancelled' ? 'btn-primary' : 'disabled btn-gray'} btn-lg rounded-0 d-block`" @click="formSubmit">
              <template v-if="IS_SUBMITED">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </template>
              <span v-else><i class="fa-solid fa-floppy-disk me-2"></i>{{ $t('messages.save_appointment') }}</span>
            </button>
          </div>
        </div>
      </template>
      <template v-else-if="SINLGE_STEP == 'CHECK_OUT' && status == 'checkout'">
        <div class="offcanvas-header">
          <div class="d-flex gap-2 align-items-center">
            <h4 class="offcanvas-title" id="form-offcanvasLabel">Checkout</h4>
            <small class="badge bg-success" v-if="is_paid">{{ $t('booking.lbl_is_paid') }}</small>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body border-top">
          <div v-if="selectedCustomer" class="border-bottom">
            <div class="d-flex align-items-start gap-3 mb-2">
              <img :src="selectedCustomer.profile_image" alt="avatar" class="img-fluid avatar avatar-60 rounded-pill" />
              <div class="flex-grow-1">
                <div class="gap-2">
                  <strong>{{ selectedCustomer.full_name }}</strong>
                  <p class="m-0">
                    <small>Client since {{ moment(selectedCustomer.created_at).format('MMMM YYYY') }}</small>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <ul class="form-group list-group list-group-flush">
            <li v-for="(service, index) in selectedService" :key="index" class="list-group-item py-3 px-1">
              <div class="d-flex flex-column gap-2">
                <div class="d-flex align-items-center justify-content-between">
                  <h6>{{ service.service_name }} ({{ formatCurrencyVue(service.service_price) }})</h6>
                  <button type="button" v-if="!is_paid" @click="removeService(service.service_id)" class="btn btn-sm text-danger"><i class="fa-regular fa-trash-can"></i></button>
                </div>
                <p class="m-0">
                  <label><i>{{ $t('booking.lbl_with') }}</i></label> <strong>{{ service.employee?.full_name || selectedEmployee?.name || '' }}</strong>
                </p>
                <div>
                  <label><i>{{ $t('booking.lbl_at') }}</i></label> <strong>{{ moment(service.start_date_time).format('LT') }}</strong> <span class="px-2">|</span> <label class=" me-2"> <i>For:</i></label><strong> {{ service. duration_min }} Min</strong>
                </div>
              </div>
            </li>
          </ul>
          <div v-if="services_id.length < service.options.length" class="text-center">
            <Multiselect v-if="newService" :canClear="false" placeholder="Select Service" ref="serviceInput" class="" v-model="services_id" :value="services_id" v-bind="multipleSelectOption" :options="service.options" @select="serviceSelect" id="service_ids">
              <template v-slot:multiplelabel="{ values }">
                <div class="multiselect-multiple-label">Select Service</div>
              </template>
            </Multiselect>
            <template v-else>
              <a href="javascript:void(0)" v-if="!is_paid" @click="addNewService" class="btnw-100"><i class="fa-solid fa-circle-plus"></i> {{ $t('booking.lbl_add_service') }}</a>
            </template>
          </div>
        </div>
        <div class="offcanvas-footer border-top">
          <div class="form-group m-0 p-3 d-flex justify-content-between">
            <label for=""><strong>{{ $t('booking.lbl_sub_tot') }} </strong> </label>
            <span>{{ formatCurrencyVue(SUB_TOTAL_SERVICE_AMOUNT) }}</span>
          </div>
          <div class="d-grid gap-3">
            <button type="button" :disabled="IS_SUBMITED" v-if="services_id.length > 0" class="btn btn-primary btn-lg rounded-0 d-block" @click="formSubmitCheckout">
              <template v-if="IS_SUBMITED">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </template>
              <template v-else>
                <template v-if="is_paid">
                  <i class="fa-solid fa-floppy-disk mx-2"></i>{{ $t('booking.lbl_complete_now') }}
                </template>
                <template v-else>
                  <i class="fa-solid fa-floppy-disk mx-2"></i>{{ $t('booking.lbl_got_to_payment') }}
                </template>
              </template>
            </button>
          </div>
        </div>
      </template>
      <template v-else-if="SINLGE_STEP == 'PAYMENT'">
        <div class="offcanvas-header">
          <h4 class="offcanvas-title" id="form-offcanvasLabel">{{ $t('booking.lbl_payment') }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

        </div>
        <div class="offcanvas-body border-top">
          <PaymentForm @updatePaymentData="updatePaymentData" :booking-id="id" :booking-status="status"></PaymentForm>
        </div>
        <div class="offcanvas-footer">
          <div class="d-grid gap-3">
            <button type="button" :disabled="IS_SUBMITED" class="btn btn-primary btn-lg rounded-0 d-block" @click="formSubmitPaynow">
              <template v-if="IS_SUBMITED">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </template>
              <template v-else><i class="fa-solid fa-floppy-disk"></i> {{ $t('booking.lbl_pay_now') }}</template>
            </button>
          </div>
        </div>
      </template>
    </div>
  </form>

  <CustomerCreate :data="newCustomerData" @submit="externalFormCreation"></CustomerCreate>
</template>
<script setup>
import { ref, reactive, watch, onMounted, computed } from 'vue'
import FlatPickr from 'vue-flatpickr-component'
import { useBookingStore } from '../store/booking'
import { EDIT_URL, STORE_URL, UPDATE_URL, UPDATE_STATUS } from '../constant/booking'

// Select Options List Request
import { EMPLOYEE_LIST, CUSTOMER_LIST, SERVICE_LIST, SLOT_LIST, PAYMENT_PUT_URL, UPDATE_PAYMENT_DATA, CHECKOUT_URL, STRIPE_PAYMENT_DATA } from '../constant/booking'
import { BRANCH_LIST } from '@/vue/constants/branch'

import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'

import { useRequest,useOnOffcanvasHide, useOnOffcanvasShow } from '@/helpers/hooks/useCrudOpration'

// Modals
import CustomerCreate from '@/vue/components/Modal/CustomerCreate.vue'

// Element Component
import BookingHeader from './BookingFormElements/BookingHeader.vue'
import BookingStatus from './BookingFormElements/BookingStatus.vue'
import PaymentForm from './Forms/PaymentForm.vue'
import InvoiceComponent from './Forms/InvoiceComponent.vue'

import { useSelect } from '@/helpers/hooks/useSelect'
import moment from 'moment'

const { getRequest, storeRequest, updateRequest, listingRequest } = useRequest()
// Event Emits
const emit = defineEmits(['onSubmit'])

const formatCurrencyVue = (value) => {
  if(window.currencyFormat !== undefined) {
    return window.currencyFormat(value)
  }
  return value
}
// Props
const props = defineProps({
  statusList: { type: Object },
  bookingType: { type: String, default: 'GLOBAL_BOOKING' },
  bookingData: {
    default: () => {
      return {
        id: 0,
        employee_id: null,
        start_date_time: null,
        branch_id: null
      }
    }
  }
})
const IS_SUBMITED = ref(false)
const filterStatus = (value) => {
  if(props.statusList) {
    return props.statusList[value]
  }
  return {is_disabled: false}
}

const current_date = ref(moment().format('YYYY-MM-DD'))
const config = ref({
  dateFormat: 'Y-m-d',
  defaultDate: 'today',
  static: true
})

watch(
  () => props.bookingType,
  (value) => {
    // console.log(value)
  }
)

watch(
  () => props.bookingData,
  (value) => {
    status.value = 'pending'
    store.updateStep('LOADER')
    if (value.id !== null && value.id !== undefined && value.id !== 0) {
      id.value = value.id
      getRequest({ url: EDIT_URL, id: id.value }).then((res) => {
        if (res.status) {
          store.updateStep('MAIN')
          setFormData(res.data)
          branchSelect(res.data.branch_id)
          employeeSelect(res.data.employee_id)
        }
      })
    } else {
      store.updateStep('MAIN')
      setFormData(defaultData())
      branch_id.value = value.branch_id
      employee_id.value = value.employee_id
      start_date_time.value = moment(value.start_date_time).format('YYYY-MM-DD HH:mm:ss')
      if(value.start_date_time) {
        current_date.value = moment(value.start_date_time).format('YYYY-MM-DD')
      } else {
        current_date.value = moment().format('YYYY-MM-DD')
      }
      branchSelect(value.branch_id)
      employeeSelect(employee_id.value)
    }
  },
  { deep: true }
)

// Vee-Validation Validations
const validationSchema = yup.object({
  start_date_time: yup.string().required('Start Date Time is required'),
  branch_id: yup.string().required('Branch is required'),
  employee_id: yup.string().required('Employee is required'),
  services_id: yup.array().required('Services is required'),
  user_id: yup.string().required('User is required')
})

const { handleSubmit, errors, resetForm } = useForm({ validationSchema })
const { value: id } = useField('id')
const { value: note } = useField('note')
const { value: start_date_time } = useField('start_date_time')
const { value: employee_id } = useField('employee_id')
const { value: branch_id } = useField('branch_id')
const { value: user_id } = useField('user_id')
const { value: status } = useField('status')
const { value: services_id } = useField('services_id')
const { value: is_paid } = useField('is_paid')

status.value = 'pending'
services_id.value = []

const errorMessages = ref({})

// Default FORM DATA
const defaultData = () => {
  errorMessages.value = {}
  return {
    id: null,
    branch_id: props.bookingData.branch_id || null,
    note: '',
    start_date_time: null,
    employee_id: props.bookingData.employee_id || null,
    status: 'pending',
    services_id: [],
    is_paid: 0
  }
}

//  Reset Form
const setFormData = (data) => {
  IS_SUBMITED.value = false;
  newService.value = false
  if (data.status == 'checkout') {
    store.updateStep('CHECK_OUT')
  }
  if(data.services !== undefined && data.services.length > 0) {
    selectedService.value = data.services
  } else {
    selectedService.value = []
  }
  resetForm({
    values: {
      id: data.id,
      branch_id: data.branch_id,
      note: data.note,
      start_date_time: data.start_date_time,
      employee_id: data.employee_id,
      user_id: data.user_id,
      status: data.status,
      services_id: data.services_id,
      is_paid: data.is_paid,
    }
  })
}

// Emit Listner Functions
const externalFormCreation = (e) => {
  switch (e.type) {
    case 'create_customer':
      getCustomers(() => (user_id.value = e.value))
      break
  }
}

// Select Options
const singleSelectOption = ref({
  createOption: true,
  closeOnSelect: true,
  searchable: true
})

const multipleSelectOption = ref({
  mode: 'multiple',
  closeOnSelect: false,
  searchable: true
})
const branch = ref({ options: [], list: [] })
const employee = ref({ options: [], list: [] })
const customer = ref({ options: [], list: [] })
const service = ref({ options: [], list: [] })
const slots = ref([])

useOnOffcanvasHide('booking-form', () => setFormData(defaultData()))
useOnOffcanvasShow('booking-form', () => {
  useSelect({ url: BRANCH_LIST }, { value: 'id', label: 'name' }).then((data) => (branch.value = data))
  branch_id.value = props.bookingData.branch_id
  getCustomers()
  branchSelect(branch_id.value)
})

const getCustomers = (cb) =>
  useSelect({ url: CUSTOMER_LIST }, { value: 'id', label: 'full_name' }).then((data) => {
    customer.value = data
    if (typeof cb == 'function') {
      cb()
    }
  })

const dateChange = () => {
  getSlots()
  start_date_time.value = null
}
const getSlots = () => {
  listingRequest({ url: SLOT_LIST, data: { branch_id: branch_id.value, date: current_date.value } }).then((res) => {
    if (res.status) {
      slots.value = res.data
    }
  })
}
// On Select
const branchSelect = (value) => {
  useSelect({ url: EMPLOYEE_LIST, data: { branch_id: value } }, { value: 'id', label: 'name' }).then((data) => (employee.value = data))
  getSlots()
}
const removeBranch = (value) => {
  employee_id.value = null
  start_date_time.value = null
  user_id.value = null
  selectedCustomer.value = null
  selectedService.value = []
}
const employeeSelect = (value) => {
  useSelect({ url: SERVICE_LIST, data: { id: value, branch_id: branch_id.value } }, { value: 'service_id', label: 'service_name' }).then((data) => (service.value = data))
}
const removeEmployee = () => {
  selectedService.value = []
  services_id.value = []
}
const newCustomerData = ref(null)
const customerSelect = (value) => {
  if(_.isString(value)) {
    newCustomerData.value = {
      first_name: value.split(" ")[0] || '',
      last_name: value.split(" ")[1] || ''
    }
    bootstrap.Modal.getOrCreateInstance($('#exampleModal')).show()
    user_id.value = null
  }
}
const slotSelect = () => {
  resetServiceTime()
}
const removeSlot = () => {
  resetServiceTime()
}

//  Customer Select & Unselect & Selected Values
const selectedCustomer = computed(() => customer.value.list.find((customer) => customer.id == user_id.value) ?? null)
const selectedEmployee = computed(() => employee.value.list.find((employee) => employee.id == employee_id.value) ?? null)
const addCustomer = () => {}

const removeCustomer = () => {
  user_id.value = null
  services_id.value = []
  selectedService.value = []
}

// const selectedService = computed(() => service.value.list.filter((ser) => services_id.value.includes(ser.id)))
const selectedService =ref([])
const removeService = (id) => {
  const servicesIds = services_id.value
  services_id.value = servicesIds.filter((serviceid) => serviceid !== id)
  selectedService.value = selectedService.value.filter((BKservice) => BKservice.service_id !== id)
  resetServiceTime()
}
const newService = ref(false)
const serviceInput = ref(null)
const addNewService = (value) => {
  newService.value = true
  setTimeout(() => {
    serviceInput.value.open()
  }, 100)
}
const serviceSelect = (value) => {
  const filteredService = service.value.list.find((ser) => ser.service_id == value)
  const bookingService = {
    id: null,
    start_date_time: null,
    service_name: filteredService.service_name,
    employee_id: employee_id.value,
    booking_id: null,
    service_id: value,
    branch_id: branch_id.value,
    service_price: filteredService.service_price,
    duration_min: filteredService.duration_min,
  }
  selectedService.value.push(bookingService)
  resetServiceTime()
  newService.value = false
}
const resetServiceTime = () => {
  let startTime = moment(start_date_time.value)
  selectedService.value.forEach((bookingService, index) => {
    if(index > 0) {
      const lastService = selectedService.value[index - 1]
      startTime = moment(lastService.start_date_time)
      startTime = startTime.add(lastService.duration_min,'minutes')
    }
    bookingService.start_date_time = startTime.format('YYYY-MM-DD HH:mm:ss')
    selectedService.value[index] = bookingService
  })
}
const payment_data = ref(null)
const stripe_payment_data = ref(null)
const store = useBookingStore()
const SINLGE_STEP = computed(() => store.singleStep)
const SUB_TOTAL_SERVICE_AMOUNT = computed(() => selectedService.value.reduce((total, service) => total + service.service_price, 0))
const formSubmit = handleSubmit((values) => {
  if(!IS_SUBMITED.value) {
    IS_SUBMITED.value = true;
    values['services'] = selectedService.value
    if (id.value > 0) {
      updateRequest({ url: UPDATE_URL, id: id.value, body: values }).then((res) => {
        submiting_booking(res)
      })
    } else {
      storeRequest({ url: STORE_URL, body: values }).then((res) => {
        submiting_booking(res)
      })
    }
  }
})
const updateStatus = (data) => {
  setFormData(data)
  emit('onSubmit')
}
const submiting_booking = (res) => {
  IS_SUBMITED.value = false;
  if (res.status) {
    window.successSnackbar(res.message)
    if(props.bookingType == 'CALENDER_BOOKING') {
      setFormData(res.data)
    } else {
      setFormData(defaultData())
      const elem = document.getElementById('booking-form')
      const form = bootstrap.Offcanvas.getOrCreateInstance(elem)
      form.hide()
      if(document.getElementById('booking-datatable') != null) {
        window.renderedDataTable.ajax.reload(null, false)
      }
    }
  } else {
    window.errorSnackbar(res.message)
  }
  emit('onSubmit')
}
const formSubmitCheckout = () => {
  if(!IS_SUBMITED.value) {
    const values = {services: selectedService.value}
    IS_SUBMITED.value = true;
    if(is_paid.value) {
      const data = {
        status: 'completed',
      }
      updateRequest({ url: UPDATE_STATUS, id: id.value, body: data }).then((res) => {
        if(res.status) {
          store.updateStep('MAIN')
          window.successSnackbar(res.message)
          updateStatus(res.data)
        }
      })
    } else {
      updateRequest({ url: CHECKOUT_URL, id: id.value, body: values }).then((res) => {
        if (res.status) {
          setFormData(res.data)
          submiting_booking(res)
          store.updateStep('PAYMENT')
        }
      })
    }
  }
}
const updatePaymentData = (data) => {
  payment_data.value = data
}
const formSubmitPaynow = () => {
  if(!IS_SUBMITED.value) {
    IS_SUBMITED.value = true;
    updateRequest({ url: PAYMENT_PUT_URL, id: id.value, body: payment_data.value }).then((res) => {

      switch(res.data.payment_method) {
        case 'razorpay':

          if(res.data.public_key !='') {

          openRazorpay(res.data);
          }else{

            window.errorSnackbar('Razorpay key does not exist')
            errorMessages.value = 'Razorpay key does not exist'
          }
          break;

        case 'stripe':
          stripe_payment_data.value = {
            booking_transaction_id: res.data.booking_transaction_id,
            currency: res.data.currency,
            payment_method: res.data.payment_method,
            total_amount: res.data.total_amount,
          };

          if(res.data.public_key !=''){

            openStripe(stripe_payment_data.value);

            }else{

              window.errorSnackbar('Stripe Secret key does not exist')
              errorMessages.value = 'Stripe Secret key does not exist'
          }

          break;

        default:
          submiting_booking(res.data);
          setFormData(res.data.data);
          store.updateStep('MAIN');
          break;
      }
    })
  }
}

const openRazorpay = (data) => {

  alert(data.total_amount);
  var options = {
    key: data.public_key, // Enter the Key ID generated from the Dashboard
    amount: data.total_amount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    currency: data.currency,
    name: 'Acme Corp', //your business name
    description: 'Test Transaction',
    image: 'https://example.com/your_logo',

    handler: function (response) {
      response.razorpay_payment_id = response.razorpay_payment_id
      response.total_amount = data.total_amount
      response.currency = data.currency

      updateRequest({ url: UPDATE_PAYMENT_DATA, id: data.booking_transaction_id, body: { response } }).then((res) => {
        submiting_booking(res.data)
        setFormData(res.data.booking)
        store.updateStep('MAIN')
      })
    },

    notes: {
      address: 'Razorpay Corporate Office'
    },
    theme: {
      color: '#3399cc'
    }
  }
  var rzp1 = new Razorpay(options)
  rzp1.on('payment.failed', function (response) {
    window.errorSnackbar(response.error.description)
    errorMessages.value = response.error.description
  })

  rzp1.open()
}

const openStripe = (data) => {

  storeRequest({ url: STRIPE_PAYMENT_DATA, body: { data } }).then((res) => {

    if(res.status == true){

      var newWindow = window.open(res.data_url, '_blank');

    }else{

      window.errorSnackbar(res.data.message)
      errorMessages.value = res.data.message

    }

  })
}
</script>

<style scoped>
.offcanvas {
  box-shadow: none;
}
.service-duration {
  position: absolute;
  /* padding: 2px 8px; */
  bottom: -16px;
  border-radius: 0;
  border-bottom-left-radius: 4px;
  border-bottom-right-radius: 4px;
  right: 0;
}

.border-br-radius-0 {
  border-bottom-right-radius: 0;
}

[dir='rtl'] .border-br-radius-0 {
  border-bottom-left-radius: 0;
}
.date-time {
  border-top: 1px solid var(--bs-border-color);
}
.date-time > div:not(:first-child) {
  border-left: 1px solid var(--bs-border-color);
}
.list-group-flush > .list-group-item {
  color: var(--bs-body-color);
}
</style>
