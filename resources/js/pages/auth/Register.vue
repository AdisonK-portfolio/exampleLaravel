<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AuthBase
        title="Create an account"
        description="Enter your details below to create your account"
    >
        <Head title="Register" />

        <Form
            v-bind="store.form()"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="input" required :tabindex="1" autofocus autocomplete="name" name="name" placeholder="Full name"
                    />
                    <div v-show="errors.name" class="validationErr">
                        {{ errors.name }}
                    </div>
                </div>

                <div class="grid gap-2">
                    <label for="email">Email address</label>
                    <input id="email" type="email" class="px-0 mx-0" required :tabindex="2" autocomplete="email" name="email" placeholder="email@example.com" />
                    <div v-show="errors.email" class="validationErr">
                        {{ errors.email }}
                    </div>
                </div>

                <div class="grid gap-2">
                    <label for="password">Password</label>
                    <input
                        id="password" type="password" required :tabindex="3" autocomplete="new-password" name="password" placeholder="Password" />
                    <div v-show="errors.password" class="validationErr">
                        {{ errors.password }}
                    </div>
                </div>

                <div class="grid gap-2">
                    <label for="password_confirmation">Confirm password</label>
                    <input
                        id="password_confirmation" type="password" required :tabindex="4" autocomplete="new-password" name="password_confirmation" placeholder="Confirm password" />
                    <div v-show="errors.password_confirmation" class="validationErr">
                        {{ errors.password_confirmation }}
                    </div>
                </div>

                <button type="submit" class="submitBtn flex space-x-2" :tabindex="5" :disabled="processing" data-test="register-user-button"
                >
                    <Spinner v-if="processing" />
                    Create account
                </button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <Link :href="login()"  class="underline underline-offset-4" :tabindex="6">Log in</Link>
            </div>
        </Form>
    </AuthBase>
</template>
