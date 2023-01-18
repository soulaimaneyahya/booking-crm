<template>
  <h3 class="mb-5 text-2xl font-medium dark:text-gray-300">Your Listings</h3>
  <section>
    <RealtorFilters :filters="filters" />
  </section>
  <section>
    <div v-if="listings.data.length">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{'opacity-50 font-normal line-through': listing.deleted_at}">
          <div class="flex flex-col md:flex-row gap-2 md:items-start justify-between">
            <div class="block">
              <div class="xl:flex items-center gap-2">
                <Price :price="listing.price" class="text-2xl font-medium" />
                <ListingSpace :listing="listing" />
              </div>

              <div class="my-2">
                <ListingAddress :listing="listing" />
              </div>

              <div
                v-if="listing.sold_at != null"
              >
                <span class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md">sold</span>
              </div>
            </div>

            <section>
              <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                <Link class="btn-outline text-xs font-medium" :href="route('listings.show', listing.id)">Preview</Link>
                <Link class="btn-outline text-xs font-medium" :href="route('realtor.listings.edit', listing.id)">Edit</Link>
                <Link
                  v-if="!listing.deleted_at"
                  class="btn-outline text-xs font-medium" 
                  :href="route('realtor.listings.destroy', listing.id)" 
                  as="button" method="delete"
                >
                  Delete
                </Link>

                <Link
                  v-else 
                  class="btn-outline text-xs font-medium" 
                  :href="route('realtor.listings.restore', listing.id)" 
                  as="button" 
                  method="put"
                >
                  Restore
                </Link>
              </div>

              <div>
                <Link :href="route('realtor.listings.image.create', listing.id)" class="my-2 block w-full btn-outline text-xs font-medium text-center">
                  Images ({{ listing.images_count }})
                </Link>

                <Link :href="route('realtor.listings.show', listing.id)" class="block w-full btn-outline text-xs font-medium text-center">
                  Offers ({{ listing.offers_count }})
                </Link>
              </div>
            </section>
          </div>
        </Box>
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
  </section>
</template>

<script setup>
import ListingAddress from '@/shared/Components/ListingAddress.vue'
import ListingSpace from '@/shared/Components/ListingSpace.vue'
import Price from '@/shared/Components/Price.vue'
import Box from '@/shared/Components/UI/Box.vue'
import RealtorFilters from '@/shared/Components/RealtorFilters.vue'
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from '@/shared/Components/UI/Pagination.vue'
import EmptyState from '@/shared/Components/UI/EmptyState.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
const page = usePage()
const app_url = computed(() => page.props.value.app_url)

defineProps({
  listings: Object,
  filters: Object,
})

</script>
