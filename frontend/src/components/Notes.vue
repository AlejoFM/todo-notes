<template>
  <v-card class="mx-auto" max-width="344" :color="color" :title="props.title">
  <v-card-item>
    <div>
      <div class="text-caption">{{ props.content }}</div>
    </div>
  </v-card-item>
</v-card>
</template>
<script setup>
import { ref, defineProps } from 'vue';

  const variants = "elevated"
  const color = ref('indigo')
  const props = defineProps(['title', 'content']);
</script>
