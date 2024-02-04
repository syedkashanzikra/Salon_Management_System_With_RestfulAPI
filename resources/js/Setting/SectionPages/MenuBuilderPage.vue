<template>
  <div>
    <CardTitle title="Menu Builder" icon="fa fa-bars">
      <div class="d-flex align-items-center gap-2">
        <MenuBuilderForm :id="editId"></MenuBuilderForm>
        <button :disabled="IS_SUBMITED" class="btn btn-primary" name="submit" @click="submitMenuSequance">
          <template v-if="IS_SUBMITED">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
          </template>
          <template v-else> <i class="fa-solid fa-floppy-disk"></i> Submit</template>
        </button>
      </div>
    </CardTitle>
  </div>
  <nested-draggable :menus="menuitems" v-if="menuitems.length > 0" class="p-0" />
  <button :disabled="IS_SUBMITED" class="btn btn-primary" name="submit" @click="submitMenuSequance">
    <template v-if="IS_SUBMITED">
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      Loading...
    </template>
    <template v-else> <i class="fa-solid fa-floppy-disk"></i> Submit</template>
  </button>
</template>

<script setup>
import {computed, watch, onMounted, ref} from 'vue'
import CardTitle from '@/Setting/Components/CardTitle.vue'
import MenuBuilderForm from './Forms/MenuBuilderForm.vue'
import NestedDraggable from "../Components/Menu/NestedDraggable.vue";
import { MENU_LIST, MENU_LIST_UPDATE } from '@/vue/constants/setting'
import { useRequest } from '@/helpers/hooks/useCrudOpration'
import { useMenu } from "@/store/menu-state";

const store = useMenu()

const editId = computed(() => store.editId)

const menuitems = ref([])

const IS_SUBMITED = ref(false)

const getMenuList = () => {
  const { listingRequest } = useRequest()
  listingRequest({ url: MENU_LIST, data: { type: 'vertical' } }).then((res) => {
    if (res.status) {
      menuitems.value = res.data
    }
  })
}

onMounted(() => {
  getMenuList()
})

const submitMenuSequance  = () =>  {
  const { updateRequest } = useRequest()
  IS_SUBMITED.value = true
  updateRequest({url: MENU_LIST_UPDATE, id: {type: 'vertical'}, body: {menu: menuitems.value} }).then((res) => {
    if(res.status) {
      window.successSnackbar(res.message)
      setTimeout(() => {
        IS_SUBMITED.value = false
        window.location.reload()
      }, 300);
    }
  })
}
</script>


