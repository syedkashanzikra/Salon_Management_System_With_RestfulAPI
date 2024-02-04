<template>
  <div>
    <h6 class="mt-4 mb-3">Active Menu Style</h6>
    <div class="d-grid gap-3 grid-cols-3 mb-4">
      <radio-input btn-name="sidebar_menu_style" labelClass="d-block" class-name="text-center" id="navs-rounded" :defaultChecked="sidebarMenuStyle" value="sidebar-default navs-rounded" @onChange="store.sidebar_menu_style">Rounded One Side</radio-input>
      <radio-input btn-name="sidebar_menu_style" labelClass="d-block" class-name="text-center" id="navs-rounded-all" :defaultChecked="sidebarMenuStyle" value="sidebar-default navs-rounded-all" @onChange="store.sidebar_menu_style">Rounded All</radio-input>
      <radio-input btn-name="sidebar_menu_style" labelClass="d-block" class-name="text-center" id="navs-pill" :defaultChecked="sidebarMenuStyle" value="sidebar-default navs-pill" @onChange="store.sidebar_menu_style">Pill One Side</radio-input>
      <radio-input btn-name="sidebar_menu_style" labelClass="d-block" class-name="text-center" id="navs-pill-all" :defaultChecked="sidebarMenuStyle" value="sidebar-default navs-pill-all" @onChange="store.sidebar_menu_style">Pill All</radio-input>
      <radio-input btn-name="sidebar_menu_style" labelClass="d-block" class-name="text-center" id="left-bordered" :defaultChecked="sidebarMenuStyle" value="left-bordered" @onChange="store.sidebar_menu_style">Left Bordered</radio-input>
      <radio-input btn-name="sidebar_menu_style" labelClass="d-block" class-name="text-center" id="navs-full-width" :defaultChecked="sidebarMenuStyle" value="sidebar-default navs-full-width" @onChange="store.sidebar_menu_style">Full Width</radio-input>
    </div>
  </div>
</template>
<script setup>
import {computed} from 'vue'
import {useSetting} from '@/store/index'
import RadioInput from '../store/elements/RadioInput.vue'
const store = useSetting()
const sidebarMenuStyle = computed(() => store.sidebar_menu_style_value)
</script>
