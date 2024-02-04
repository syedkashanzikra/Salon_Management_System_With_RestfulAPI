<template>
  <SidebarPanel></SidebarPanel>
  <MainContent></MainContent>
</template>

<script setup>
import {onMounted, watch, computed} from 'vue'
import SidebarPanel from './SidebarPanel.vue'
import MainContent from './MainContent.vue'
import StickySidebar from 'sticky-sidebar'
import {useRouter} from 'vue-router'
onMounted(() => {
  initSidebar()
})
const router = useRouter()
watch(() => router.currentRoute.value, (value) => {
  setTimeout(() => {
    initSidebar()
  }, 100);
}, {deep: true})

const initSidebar = () => {
  console.log()
  if(window.innerWidth > 766) {
    console.log($('.card-accent-primary').height() , $('.setting-sidebar-inner').height())
    if($('.card-accent-primary').height() > $('.setting-sidebar-inner').height()) {
      window['stick_sidebar_setting'] = new StickySidebar('#setting-sidebar', {
        containerSelector: '#setting-app',
        innerWrapperSelector: '.setting-sidebar-inner',
        topSpacing: 40,
        bottomSpacing: 40
      })
    } else {
      if(window['stick_sidebar_setting'] !== undefined) {
        window['stick_sidebar_setting'].destroy()
      }
    }
  }
}
</script>
