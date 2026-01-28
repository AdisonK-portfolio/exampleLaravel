<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/password/confirm';
</script>

<template>
    <AuthLayout
        title="Confirm your password"
        description="This is a secure area of the application. Please confirm your password before continuing."
    >
        <Head title="Confirm password" />

        <Form
            v-bind="store.form()"
            reset-on-success
            v-slot="{ errors, processing }"
        >
            <div class="space-y-6">
                <div class="grid gap-2">
                    <label htmlFor="password">Password</Label>
                    <input id="password" type="password" name="password" class="mt-1 block w-full" required autocomplete="current-password" autofocus />

                    <div v-show="errors.password" class="validationErr">
                        {{ errors.password }}
                    </div>
                </div>

                <div class="flex items-center">
                    <button class="w-full submitBtn" :disabled="processing" data-test="confirm-password-button" >
                        <Spinner v-if="processing" />
                        Confirm Password
                    </button>
                </div>
            </div>
        </Form>
    </AuthLayout>
</template>
