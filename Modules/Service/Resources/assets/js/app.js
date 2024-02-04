import { InitApp } from '@/helpers/main'

import ServiceFormOffcanvas from './components/ServiceFormOffcanvas.vue'
import ServicePackageFormOffcanvas from './components/ServicePackageFormOffcanvas.vue'
import GalleryFormOffcanvas from './components/GalleryFormOffcanvas.vue'
import AssignEmployeeFormOffCanvas from './components/assign/AssignEmployeeFormOffCanvas.vue'
import AssignBranchFormOffCanvas from './components/assign/AssignBranchFormOffCanvas.vue'


const app = InitApp()

app.component('service-form-offcanvas', ServiceFormOffcanvas)
app.component('service-package-form-offcanvas',ServicePackageFormOffcanvas)

// Assign Staff & Branch Offcanvas
app.component('assign-employee-form-offcanvas', AssignEmployeeFormOffCanvas)
app.component('assign-branch-form-offcanvas', AssignBranchFormOffCanvas)

// Gallery Offcanvas
app.component('gallery-form-offcanvas', GalleryFormOffcanvas)



app.mount('[data-render="app"]');
