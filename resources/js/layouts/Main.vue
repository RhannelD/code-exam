<template>
    <div>
        <Navbar/>

        <div class="m-4">
            <slot></slot>
        </div>
    </div>
</template>

<script setup lang="ts">
import Navbar from './Navbar.vue';
</script>