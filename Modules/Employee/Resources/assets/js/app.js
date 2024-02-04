import { InitApp } from '@/helpers/main'
import EmployeeOffcanvas from './components/EmployeeOffcanvas.vue'
import ChangePassword from './components/ChangePassword.vue'

import VueTelInput from 'vue3-tel-input'
import 'vue3-tel-input/dist/vue3-tel-input.css'

const app = InitApp()

app.use(VueTelInput)
app.component('employee-offcanvas', EmployeeOffcanvas)
app.component('change-password', ChangePassword)


app.mount('[data-render="app"]');
