<script setup>
import app from './shared/config/appConfig';
import { RouterView } from 'vue-router'

document.title = `${app.name}`;
</script>

<template>
  <RouterView />
</template>

<style></style>
