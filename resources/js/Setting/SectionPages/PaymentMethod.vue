<template>
  <form @submit="formSubmit">
    <div>
      <CardTitle title="Payment Method" icon="fa-solid fa-coins"></CardTitle>
    </div>
    <div class="form-group">
      <div class="d-flex justify-content-between align-items-center">
        <label class="form-label" for="payment_method_razorpay">{{ $t('setting_payment_method.lbl_razorpay') }} </label>
        <div class="form-check form-switch">
          <input class="form-check-input" :true-value="1" :false-value="0" :value="razor_payment_method"
            :checked="razor_payment_method == 1 ? true : false" name="razor_payment_method" id="payment_method_razorpay"
            type="checkbox" v-model="razor_payment_method" />
        </div>
      </div>
    </div>
    <div v-if="razor_payment_method == 1">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="razorpay_secretkey">{{ $t('setting_payment_method.lbl_secret_key') }}</label>
            <input type="text" class="form-control" v-model="razorpay_secretkey" id="razorpay_secretkey"
              name="razorpay_secretkey" :errorMessage="errors.razorpay_secretkey"
              :errorMessages="errorMessages.razorpay_secretkey" />
            <p class="text-danger" v-for="msg in errorMessages.razorpay_secretkey" :key="msg">{{ msg }}</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="razorpay_publickey">{{ $t('setting_payment_method.lbl_app_key') }}</label>
            <input type="text" class="form-control" v-model="razorpay_publickey" id="razorpay_publickey"
              name="razorpay_publickey" :errorMessage="errors.razorpay_publickey"
              :errorMessages="errorMessages.razorpay_publickey" />
            <p class="text-danger" v-for="msg in errorMessages.razorpay_publickey" :key="msg">{{ msg }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="d-flex justify-content-between align-items-center">
        <label class="form-label" for="payment_method_stripe">{{ $t('setting_payment_method.lbl_stripe') }}</label>
        <div class="form-check form-switch">
          <input class="form-check-input" :true-value="1" :false-value="0" :value="str_payment_method"
            :checked="str_payment_method == 1 ? true : false" name="str_payment_method" id="payment_method_stripe"
            type="checkbox" v-model="str_payment_method" />
        </div>
      </div>
    </div>
    <div v-if="str_payment_method == 1">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="stripe_secretkey">{{ $t('setting_payment_method.lbl_secret_key') }}</label>
            <input type="text" class="form-control" v-model="stripe_secretkey" id="stripe_secretkey"
              name="stripe_secretkey" :errorMessage="errors.stripe_secretkey"
              :errorMessages="errorMessages.stripe_secretkey" />
            <p class="text-danger" v-for="msg in errorMessages.stripe_secretkey" :key="msg">{{ msg }}</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="stripe_publickey">{{ $t('setting_payment_method.lbl_app_key') }}</label>
            <input type="text" class="form-control" v-model="stripe_publickey" id="stripe_publickey"
              name="stripe_publickey" :errorMessage="errors.stripe_publickey"
              :errorMessages="errorMessages.stripe_publickey" />
            <p class="text-danger" v-for="msg in errorMessages.stripe_publickey" :key="msg">{{ msg }}</p>
          </div>
        </div>
      </div>
    </div>
    <SubmitButton :IS_SUBMITED="IS_SUBMITED"></SubmitButton>
  </form>
</template>

<script setup>
import { ref, watch } from 'vue'
import CardTitle from '@/Setting/Components/CardTitle.vue'
import { useField, useForm } from 'vee-validate'
import { STORE_URL, GET_URL } from '@/vue/constants/setting'
//
import * as yup from 'yup';
import { useRequest } from '@/helpers/hooks/useCrudOpration'
import { onMounted } from 'vue'
import { createRequest } from '@/helpers/utilities'
import SubmitButton from './Forms/SubmitButton.vue'
const { storeRequest } = useRequest()
const IS_SUBMITED = ref(false)
//  Reset Form
const setFormData = (data) => {
  resetForm({
    values: {
      razor_payment_method: data.razor_payment_method || 0,
      razorpay_secretkey: data.razorpay_secretkey || '',
      razorpay_publickey: data.razorpay_publickey || '',
      str_payment_method: data.str_payment_method || 0,
      stripe_secretkey: data.stripe_secretkey || '',
      stripe_publickey: data.stripe_publickey || '',
    }
  })
}



const validationSchema = yup.object({
  razorpay_secretkey: yup.string().test('razorpay_secretkey', 'Must be a valid RazorPay key', function (value) {
    if (this.parent.razor_payment_method == '1' && !value) {
      return false;
    }
    return true
  }),
  razorpay_publickey: yup.string().test("Must be a valid RazorPay Publickey", function (value) {
    if (this.parent.razor_payment_method == '1' && !value) {
      return false;
    }
    return true
  }),
  stripe_secretkey: yup.string().test('stripe_secretkey', 'Must be a valid Stripe key', function (value) {
    if (this.parent.str_payment_method == '1' && !value) {
      return false;
    }
    return true
  }),
  stripe_publickey: yup.string().test("Must be a valid Stripe Publickey", function (value) {
    if (this.parent.str_payment_method == '1' && !value) {
      return false;
    }
    return true
  }),
})
const { handleSubmit, errors, resetForm } = useForm({ validationSchema })
const errorMessages = ref({})
const { value: razor_payment_method } = useField('razor_payment_method')
const { value: razorpay_secretkey } = useField('razorpay_secretkey')
const { value: razorpay_publickey } = useField('razorpay_publickey')
const { value: str_payment_method } = useField('str_payment_method')
const { value: stripe_secretkey } = useField('stripe_secretkey')
const { value: stripe_publickey } = useField('stripe_publickey')

watch(() => razor_payment_method.value, (value) => {
  if(value == '0') {
    razorpay_secretkey.value = ''
    razorpay_publickey.value = ''
  }
}, {deep: true})
watch(() => str_payment_method.value, (value) => {
  if(value == '0') {
    stripe_secretkey.value = ''
    stripe_publickey.value = ''
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
const data = 'razor_payment_method,razorpay_secretkey,razorpay_publickey,str_payment_method,stripe_secretkey,stripe_publickey'
onMounted(() => {
  createRequest(GET_URL(data)).then((response) => {
    setFormData(response)
  })
})

//Form Submit
const formSubmit = handleSubmit((values) => {
  IS_SUBMITED.value = true
  const newValues = {}
  Object.keys(values).forEach((key) => {
    newValues[key] = values[key] || ''
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
