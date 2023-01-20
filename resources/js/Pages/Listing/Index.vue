<template>
  <h3 class="mb-5 text-2xl font-medium dark:text-gray-300">Listings</h3>
  <Filters :filters="filters" />
  <div v-if="listings.data.length">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      <Listing v-for="(listing, index) in listings.data" :key="index" :listing="listing" />
    </div>
    <div class="w-full flex justify-center my-4">
      <Pagination :links="listings.links" />
    </div>
  </div>
  <div v-else>
    <EmptyState class="my-12">
      <div class="flex justify-center">
        <img :src="`${app_url}/img/void.svg`" width="150" alt="void" />
      </div>
      <h1 class="text-center my-4 text-xl fot-bold text-gray-600 dark:text-gray-200">No Data Found</h1>
    </EmptyState>
  </div>
</template>
<script setup>
import Listing from '@/shared/Components/Listing.vue'
import Pagination from '@/shared/Components/UI/Pagination.vue'
import Filters from '@/shared/Components/Filters.vue'
import EmptyState from '@/shared/Components/UI/EmptyState.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const page = usePage()

defineProps({ 
  listings: Object,
  filters: Object,
})

const app_url = computed(() => page.props.value.app_url)

</script>
