<template>
  <div>

    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
      <div class="container mx-auto">
        <nav class="p-4 flex items-center justify-between">
          <!-- logo-appName -->
          <Link :href="route('listings.index')" class="inline-flex items-center gap-3 text-lg font-bold md:text-xl">
            <div class="flex items-center justify-center w-8 h-8 rounded-lg shadow-lg border-z bg-gradient-to-r from-indigo-500 to-indigo-600">
              <img class="w-4 h-4" src="https://laraveldaily.com/img/logos/mono.svg" alt="" />
            </div>
            <span>{{ appName }}</span>
          </Link>
          <div>
            <!-- v-if user -->
            <div v-if="!user" class="flex items-center justify-between gap-5">
              <Link :href="route('login')">Login</Link>
              <Link :href="route('register')">Register</Link>
            </div>
            <!-- v-else -->
            <div v-else class="flex items-center justify-between gap-5">
              <!-- links -->
              <Link :href="route('logout')" method="POST" as="button" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                </svg>
                <span>Logout</span>
              </Link>
              <div class="text-gray-500">|</div>
                <!-- notifications bills -->
                <Link
                  class="text-gray-500 relative pr-2 py-2 text-lg"
                  :href="route('notifications.index')"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                  </svg>
                  <div v-if="unreadNotificationsCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
                    {{ unreadNotificationsCount }}
                  </div>
                </Link>
              <Link class="text-sm text-gray-800 dark:text-gray-300" :href="route('realtor.listings.index')">{{ user.name }}</Link>
              <Link :href="route('realtor.listings.create')" class="btn-primary">+ New Listing</Link>
            </div>
          </div>
        </nav>
      </div>
    </header>

    <main class="container mx-auto p-4">
      <!-- flash message -->
      <div v-if="flashSuccess" class="flex items-center gap-3 mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
        <span>{{ flashSuccess }}</span>
      </div>

      <slot>Default</slot>
    </main>

  </div>
</template>
<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'

// page.props.value.flash.success
const page = usePage()

const flashSuccess = computed(() => page.props.value.flash.success)
const appName = computed(() => page.props.value.app_name)

const unreadNotificationsCount = computed(() => Math.min(page.props.value.user.unread_notifications_count, 9));

const user = computed(() => page.props.value.user)
</script>
