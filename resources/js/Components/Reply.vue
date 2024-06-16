<script setup>
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "./PrimaryButton.vue";
import InputError from "./InputError.vue";
import { ref } from "vue";

const props = defineProps(["user_id", "blog_id"]);

const form = useForm({
  body: "",
  blog_id: props.blog_id,
  user_id: props.user_id,
});

const replying = ref(false);
</script>

<template>
  <!-- REPLY TO POST -->
  <div v-if="!replying" class="flex justify-end divide-y-4">
    <button
      class="text-2x text-black/50 font-extrabold hover:text-indigo-500"
      @click="replying = true"
    >
      REPLY
    </button>
  </div>
  <form
    v-else
    class="bg-gray-50"
    @submit.prevent="
      form.post(route('comments.store'), {
        onSuccess: () => form.reset(),
      })
    "
  >
    <div class="p-6 flex space-x-2">
      <div class="flex-1">
        <textarea
          name="body"
          v-model="form.body"
          class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        ></textarea>
        <InputError :message="form.errors.message" class="mt-2" />
        <div class="space-x-2 flex justify-end">
          <PrimaryButton class="mt-4">Save</PrimaryButton>
          <button
            class="mt-4"
            type="submit"
            @click="
              replying = false;
              form.reset();
              form.clearErrors();
            "
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </form>
</template>