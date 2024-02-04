<template>
  <form @submit="formSubmit">
    <div>
      <CardTitle title="Integration" icon="fa-solid fa-sliders"></CardTitle>
    </div>
    <div class="form-group">
      <div class="d-flex justify-content-between align-items-center">
        <label class="form-label" for="category-is_google_login">{{ $t('setting_integration_page.lbl_google_login') }} </label>
        <div class="form-check form-switch">
          <input class="form-check-input" :true-value="1" :false-value="0" :value="is_google_login" :checked="is_google_login == 1 ? true : false" name="is_google_login" id="category-is_google_login" type="checkbox" v-model="is_google_login" />
        </div>
      </div>
    </div>
    <div v-if="is_google_login == 1">
      <div class="row">
        <div class="col-md-6">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_secret_key')" placeholder="" v-model="google_secretkey" :error-message="errors['google_secretkey']" :error-messages="errorMessages['google_secretkey']"></InputField>
        </div>
        <div class="col-md-6">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_public_key')" placeholder="" v-model="google_publickey" :error-message="errors['google_publickey']" :error-messages="errorMessages['google_publickey']"></InputField>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="d-flex justify-content-between align-items-center">
        <label class="form-label" for="category-is_one_signal_notification">{{ $t('setting_integration_page.lbl_onesignal') }} </label>
        <div class="form-check form-switch">
          <input class="form-check-input" :true-value="1" :false-value="0" :value="is_one_signal_notification" :checked="is_one_signal_notification == 1 ? true : false" name="is_one_signal_notification" id="category-is_one_signal_notification" type="checkbox" v-model="is_one_signal_notification" />
        </div>
      </div>
    </div>
    <div v-if="is_one_signal_notification == 1">
      <div class="row">
        <div class="col-md-4">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_api_key')" placeholder="" v-model="onesignal_app_id" :error-message="errors['onesignal_app_id']" :error-messages="errorMessages['onesignal_app_id']"></InputField>
        </div>
        <div class="col-md-4">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_rest_api_key')" placeholder="" v-model="onesignal_rest_api_key" :error-message="errors['onesignal_rest_api_key']" :error-messages="errorMessages['onesignal_rest_api_key']"></InputField>
        </div>
        <div class="col-md-4">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_channel_id')" placeholder="" v-model="onesignal_channel_id" :error-message="errors['onesignal_channel_id']" :error-messages="errorMessages['onesignal_channel_id']"></InputField>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="d-flex justify-content-between align-items-center">
        <label class="form-label" for="category-is_custom_webhook_notification">{{ $t('setting_integration_page.lbl_webhook') }} </label>
        <div class="form-check form-switch">
          <input class="form-check-input" :true-value="1" :false-value="0" :value="is_custom_webhook_notification" :checked="is_custom_webhook_notification == 1 ? true : false" name="is_custom_webhook_notification" id="category-is_custom_webhook_notification" type="checkbox" v-model="is_custom_webhook_notification" />
        </div>
      </div>
    </div>
    <div v-if="is_custom_webhook_notification == 1">
      <div class="row">
        <div class="col-md-6">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_custom_webhook_content_key')" placeholder="" v-model="custom_webhook_content_key" :error-message="errors['custom_webhook_content_key']" :error-messages="errorMessages['custom_webhook_content_key']"></InputField>
        </div>
        <div class="col-md-6">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_custom_webhook_url')" placeholder="" v-model="custom_webhook_url" :error-message="errors['custom_webhook_url']" :error-messages="errorMessages['custom_webhook_url']"></InputField>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="d-flex justify-content-between align-items-center">
        <label class="form-label" for="category-is_map_key">{{ $t('setting_integration_page.lbl_google') }}</label>
        <div class="form-check form-switch">
          <input class="form-check-input" :true-value="1" :false-value="0" :value="is_map_key" :checked="is_map_key == 1 ? true : false" name="is_map_key" id="category-is_map_key" type="checkbox" v-model="is_map_key" />
        </div>
      </div>
    </div>
    <div v-if="is_map_key == 1">
      <div class="row">
        <div class="col-md-6">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_google_key')" placeholder="" v-model="google_maps_key" :error-message="errors['google_maps_key']" :error-messages="errorMessages['google_maps_key']"></InputField>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="d-flex justify-content-between align-items-center">
        <label class="form-label" for="category-is_application_link">{{ $t('setting_integration_page.lbl_application') }}</label>
        <div class="form-check form-switch">
          <input class="form-check-input" :true-value="1" :false-value="0" :value="is_application_link" :checked="is_application_link == 1 ? true : false" name="is_application_link" id="category-is_application_link" type="checkbox" v-model="is_application_link" />
        </div>
      </div>
    </div>
    <div v-if="is_application_link == 1">
      <div class="row">
        <div class="col-md-6">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_playstore')" placeholder="" v-model="customer_app_play_store" :error-message="errors['customer_app_play_store']" :error-messages="errorMessages['customer_app_play_store']"></InputField>
        </div>
        <div class="col-md-6">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_appstore')" placeholder="" v-model="customer_app_app_store" :error-message="errors['customer_app_app_store']" :error-messages="errorMessages['customer_app_app_store']"></InputField>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="d-flex justify-content-between align-items-center">
        <label class="form-label" for="category-isForceUpdate">{{ $t('setting_integration_page.lbl_isforceupdate') }}</label>
        <div class="form-check form-switch">
          <input class="form-check-input" :true-value="1" :false-value="0" :value="isForceUpdate" :checked="isForceUpdate == 1 ? true : false" name="isForceUpdate" id="category-isForceUpdate" type="checkbox" v-model="isForceUpdate" />
        </div>
      </div>
    </div>
    <div v-if="isForceUpdate == 1">
      <div class="row">
        <div class="col-md-6">
          <InputField class="col-md-12" type="text" :is-required="true" :label="$t('setting_integration_page.lbl_version_code')" placeholder="" v-model="version_code" :error-message="errors['version_code']" :error-messages="errorMessages['version_code']"></InputField>
        </div>
      </div>
    </div>

    <SubmitButton :IS_SUBMITED="IS_SUBMITED"></SubmitButton>
  </form>
</template>
<script setup>
import { ref, watch } from 'vue'
import CardTitle from '@/Setting/Components/CardTitle.vue'
import * as yup from 'yup'
import { useField, useForm } from 'vee-validate'
import { STORE_URL, GET_URL } from '@/vue/constants/setting'
import { useRequest } from '@/helpers/hooks/useCrudOpration'
import { onMounted } from 'vue'
import { createRequest } from '@/helpers/utilities'
import SubmitButton from './Forms/SubmitButton.vue'
import InputField from '@/vue/components/form-elements/InputField.vue'
const { storeRequest } = useRequest()
const IS_SUBMITED = ref(false)
//  Reset Form
const setFormData = (data) => {
  resetForm({
    values: {
      is_google_login: data.is_google_login || 0,
      is_one_signal_notification: data.is_one_signal_notification || 0,
      is_custom_webhook_notification: data.is_custom_webhook_notification || 0,
      is_map_key: data.is_map_key  || 0,
      isForceUpdate: data.isForceUpdate  || 0,
      google_secretkey: data.google_secretkey || '',
      google_publickey: data.google_publickey || '',
      onesignal_app_id: data.onesignal_app_id  || '',
      onesignal_rest_api_key: data.onesignal_rest_api_key  || '',
      onesignal_channel_id: data.onesignal_channel_id  || '',
      google_maps_key: data.google_maps_key  || '',
      version_code: data.version_code  || '',
      is_application_link: data.is_application_link  || '',
      customer_app_play_store: data.customer_app_play_store  || '',
      customer_app_app_store: data.customer_app_app_store  || '',
      custom_webhook_content_key: data.custom_webhook_content_key  || '',
      custom_webhook_url: data.custom_webhook_url  || '',
    }
  })
}
//validation
const validationSchema = yup.object({
  google_secretkey: yup.string().test('google_secretkey' , 'Must be a valid Google key', function(value){
    if(this.parent.is_google_login == '1' && !value) {
      return false;
    }
    return true
  }),
  google_publickey: yup.string().test("Must be a valid Google Publickey", function(value){
    if(this.parent.is_google_login == '1' && !value) {
      return false;
    }
    return true
  }),
  onesignal_app_id: yup.string().test('onesignal_app_id','Must be a valid APP ID', function(value) {
    if(this.parent.is_one_signal_notification == '1' && !value) {
      return false;
    }
    return true
  }),
  onesignal_rest_api_key: yup.string().test('onesignal_rest_api_key', "Must be a valid REST KEY", function(value) {
    if(this.parent.is_one_signal_notification == '1' && !value) {
      return false;
    }
    return true
  }),
  onesignal_channel_id: yup.string().test('onesignal_channel_id', "Must be a valid CHANNEL ID", function(value) {
    if(this.parent.is_one_signal_notification == '1' && !value) {
      return false;
    }
    return true
  }),
  google_maps_key: yup.string().test('google_maps_key', "Must be a valid Google MapKey", function(value) {
    if(this.parent.is_map_key == '1' && !value) {
      return false;
    }
    return true
  }),
  version_code: yup.string().test('version_code', "Minimum version code for Android is Required", function(value) {
    if(this.parent.isForceUpdate == '1' && !value) {
      return false;
    }
    return true
  }),
  customer_app_play_store: yup.string().test('customer_app_play_store',"Must be a valid Playstore App Key", function(value) {
    if(this.parent.is_application_link == '1' && !value) {
      return false;
    }
    return true
  }),
  customer_app_app_store: yup.string().test('customer_app_app_store',"Must be a valid App Key", function(value) {
    if(this.parent.is_application_link == '1' && !value) {
      return false;
    }
    return true
  }),
  custom_webhook_content_key: yup.string().test('custom_webhook_content_key',"Must be a valid wbhook content key", function(value) {
    if(this.parent.is_custom_webhook_notification == '1' && !value) {
      return false;
    }
    return true
  }),
  custom_webhook_url: yup.string().test('custom_webhook_url',"Must be a valid wbhook URL", function(value) {
    if(this.parent.is_custom_webhook_notification == '1' && !value) {
      return false;
    }
    return true
  }),
})
const { handleSubmit, errors, resetForm, validate } = useForm({validationSchema})
const errorMessages = ref({})
const { value: is_google_login } = useField('is_google_login')
const { value: is_one_signal_notification } = useField('is_one_signal_notification')
const { value: is_custom_webhook_notification } = useField('is_custom_webhook_notification')
const { value: google_secretkey } = useField('google_secretkey')
const { value: google_publickey } = useField('google_publickey')
const { value: onesignal_app_id } = useField('onesignal_app_id')
const { value: onesignal_rest_api_key } = useField('onesignal_rest_api_key')
const { value: onesignal_channel_id } = useField('onesignal_channel_id')
const { value: is_map_key } = useField('is_map_key')
const { value: isForceUpdate } = useField('isForceUpdate')
const { value: is_application_link } = useField('is_application_link')
const { value: google_maps_key } = useField('google_maps_key')
const { value: version_code } = useField('version_code')
const { value: customer_app_play_store } = useField('customer_app_play_store')
const { value: customer_app_app_store } = useField('customer_app_app_store')
const { value: custom_webhook_content_key} = useField('custom_webhook_content_key')
const { value: custom_webhook_url } = useField('custom_webhook_url')

watch(() => is_map_key.value, (value) => {
  if(value == '0') {
    google_maps_key.value = ''
  }
}, {deep: true})
watch(() => isForceUpdate.value, (value) => {
  if(value == '0') {
    version_code.value = ''
  }
}, {deep: true})
watch(() => is_google_login.value, (value) => {
  if(value == '0') {
    google_secretkey.value = ''
    google_publickey.value = ''
  }
}, {deep: true})
watch(() => is_custom_webhook_notification.value, (value) => {
  if(value == '0') {
    custom_webhook_content_key.value = ''
    custom_webhook_url.value = ''
  }
}, {deep: true})
watch(() => is_one_signal_notification.value, (value) => {
  if(value == '0') {
    onesignal_app_id.value = ''
    onesignal_rest_api_key.value = ''
    onesignal_channel_id.value = ''
  }
}, {deep: true})
// message
const display_submit_message = (res) => {
  IS_SUBMITED.value = false
  if (res.status) {
    window.successSnackbar(res.message)
  } else {
    window.errorSnackbar(res.message)
    errorMessages.value = res.errors
  }
}

//fetch data
const data = [
  'is_google_login',
  'is_one_signal_notification',
  'is_mobile_notification',
  'is_map_key',
  'isForceUpdate',
  'is_application_link',
  'is_custom_webhook_notification',
]

const onesignal_key = [
  'onesignal_app_id',
  'onesignal_rest_api_key',
  'onesignal_channel_id',
]

const custom_webhook_key = [
  'custom_webhook_content_key',
  'custom_webhook_url'
]

const customer_app = [
  'customer_app_play_store',
  'customer_app_app_store',
]
const google_map_key = [
  'google_maps_key',
]
const versions_key = [
  'version_code',
]
const google_login_key = [
  'google_secretkey',
  'google_publickey',
]
onMounted(() => {

  const customData = [
    ...data,
    ...onesignal_key,
    ...custom_webhook_key,
    ...customer_app,
    ...google_map_key,
    ...versions_key,
    ...google_login_key
  ].join(",")

  createRequest(GET_URL(customData)).then((response) => {
    setFormData(response)
  })
})

//Form Submit
const formSubmit = handleSubmit((values) => {
  IS_SUBMITED.value = true
  const newValues = {}
  Object.keys(values).forEach((key) => {
    if(values[key] !== '') {
      newValues[key] = values[key] || ''
    }
  })
  storeRequest({
    url: STORE_URL,
    body: newValues
  }).then((res) => display_submit_message(res))
})

defineProps({
  label: { type: String, default: '' },
  modelValue: { type: String, default: '' },
  placeholder: { type: String, default: '' },
  errorMessage: { type: String, default: '' },
  errorMessages: { type: Array, default: () => [] }
})
</script>
