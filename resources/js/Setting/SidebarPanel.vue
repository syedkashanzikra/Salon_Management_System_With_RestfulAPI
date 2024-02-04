<template>
  <div class="col-md-4 col-lg-3">
    <div id="setting-sidebar" class="setting-sidebar-inner">
      <div class="card">
        <div class="card-body">
          <div class="list-group list-group-flush">
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.home'}" class="btn btn-border"><i class="fas fa-cube"></i>{{ $t('setting_sidebar.lbl_General') }}</router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.misc'}" class="btn btn-border"><i class="fa-solid fa-screwdriver-wrench "></i>{{ $t('setting_sidebar.lbl_misc_setting') }}</router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.quick-booking'}" class="btn btn-border"><i class="fa-solid fa-paper-plane"></i>{{ $t('setting_sidebar.lbl_quick_booking') }}</router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.custom-code'}" class="btn btn-border"><i class="fa-solid fa-file-code"></i>{{ $t('setting_sidebar.lbl_custom_code') }}</router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.customization'}" class="btn btn-border"><i class="fa-solid fa-swatchbook"></i>{{ $t('setting_sidebar.lbl_customization') }}</router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.mail'}" class="btn btn-border"><i class="fas fa-envelope"></i>{{ $t('setting_sidebar.lbl_mail') }} </router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.notificationsetting'}" class="btn btn-border"><i class="fa-solid fa-bullhorn"></i>{{ $t('setting_sidebar.lbl_notification') }} </router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.integration'}" class="btn btn-border"><i class="fa-solid fa-sliders"></i>{{ $t('setting_sidebar.lbl_integration') }}</router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.custom-fields'}" class="btn btn-border"><i class="fa-solid fa-bars"></i>{{ $t('setting_sidebar.lbl_custom_field') }} </router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.currency-settings'}" class="btn btn-border"><i class="fa fa-dollar fa-lg mr-2"></i>{{ $t('setting_sidebar.lbl_currency_setting') }} </router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.commission'}" class="btn btn-border"><i class="fa fa-percent fa-lg mr-2"></i>{{ $t('setting_sidebar.lbl_commission') }}</router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.holiday'}" class="btn btn-border"><i class="fa-solid fa-calendar-check mr-2"></i>{{ $t('setting_sidebar.lbl_holiday') }}</router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.bussiness-hours'}" class="btn btn-border"><i class="fa-solid fa-clock"></i>{{ $t('setting_sidebar.lbl_bussiness') }} </router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.payment-method'}" class="btn btn-border"><i class="fa-solid fa-coins"></i>{{ $t('setting_sidebar.lbl_payment') }} </router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.language-settings'}" class="btn btn-border"><i class="fa fa-language" aria-hidden="true"></i>{{ $t('setting_sidebar.lbl_language') }} </router-link></div>
            <div class="mb-3" @click="toggle()"><router-link :to="{name: 'Settings.menu-builder'}" class="btn btn-border"><i class="fa fa-bars" aria-hidden="true"></i>{{ $t('setting_sidebar.lbl_menu') }} </router-link></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>

const toggle = () =>{
  const formOffcanvas = document.getElementById('offcanvas')
  formOffcanvas.classList.add("show")
}
</script>
<style scoped>
.btn-border {
  text-align: left;
  display: flex;
  align-items: center;
  gap: .75rem;
}
</style>
