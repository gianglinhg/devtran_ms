<template>
  Đây là trang settings
</template>

<script>
  import { useMenu } from '../../../stores/use-menu.js';
  export default {
    setup(){
      useMenu().onSelectedKeys(['admin-settings']);
    }
  }
</script>