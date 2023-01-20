<template>
  <h3 class="mb-5 text-2xl font-medium dark:text-gray-300">Your Notifications</h3>
  <section v-if="notifications.data.length">
    <section class="text-gray-700 dark:text-gray-400">
      <div
        v-for="notification in notifications.data" :key="notification.id" 
        class="border-b border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center"
      >
        <div>
          <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
            Offer <Price :price="notification.data.amount" /> for
            <Link
              :href="route('realtor.listings.show', notification.data.listing_id)" 
              class="text-indigo-600 dark:text-indigo-400"
            >listing</Link> was made
          </span>
        </div>
        <div>
          <Link
            v-if="!notification.read_at"
            class="btn-outline text-xs font-medium uppercase"
            :href="route('notifications.seen', notification.id)"
            as="button" method="put"
          >
            Mark as read
          </Link>
        </div>
      </div>
    </section>
    <section class="w-full flex justify-center mt-8 mb-8">
      <Pagination :links="notifications.links" />
    </section>
  </section>
  <EmptyState v-else class="my-12">
    <div class="flex justify-center">
      <img :src="`${app_url}/img/void.svg`" width="150" alt="void" />
    </div>
    <h1 class="text-center my-4 text-xl fot-bold text-gray-600 dark:text-gray-200">No notifications yet!</h1>
  </EmptyState>
</template>

<script setup>
import Price from '@/shared/Components/Price.vue'
import EmptyState from '@/shared/Components/UI/EmptyState.vue'
import Pagination from '@/shared/Components/UI/Pagination.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
const page = usePage()
const app_url = computed(() => page.props.value.app_url)

defineProps({ notifications: Object })
</script>
