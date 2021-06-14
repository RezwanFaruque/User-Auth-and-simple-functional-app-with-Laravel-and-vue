<template>
  <div id="khoj_page">
    <div class="page-title text-center">Khoj The Search Page</div>
    <div class="form-section">
      <ValidationObserver v-slot="{ invalid }">
        <form @submit.prevent="khojsubmit">
          <div class="section">
            <ValidationProvider rules="required" v-slot="{ errors }">
              <input
                :class="{
                  email: true,
                  error: errors.length > 0,
                }"
                type="text"
                placeholder="Input Values"
                v-model="formData.input_values"
              />
              <span id="error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>

          <div class="section">
            <ValidationProvider
              rules="required"
              vid="confirmation"
              v-slot="{ errors }"
            >
              <input
                :class="{
                  password: true,
                  error: errors.length > 0,
                }"
                type="text"
                placeholder="Searh Value"
                v-model="formData.search_value"
                ref="password"
              />
              <span id="error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>
          <div class="login-submit">
            <button :disabled="invalid" type="submit" class="button-submit">
              Khoj
            </button>
          </div>
        </form>
      </ValidationObserver>

      <div class="result-section">
         Result:  {{ result }}
      </div>
    </div>
  </div>
</template>

<script>
import {
  ValidationProvider,
  ValidationObserver,
} from "vee-validate/dist/vee-validate.full.esm";

export default {
  name: "Khoj",
  components: {
    ValidationObserver,
    ValidationProvider,
  },

  data: function () {
    return {
      result: "",
      formData: {
        input_values: "",
        search_value: "",
      },
    };
  },

  methods: {
    async khojsubmit() {
      this.result = "";
      return new Promise((resolve, reject) => {
        axios
          .post(
            "http://127.0.0.1:8000/api/khoj",

            this.formData,
            {
              headers: {
                Authorization: "Bearer " + localStorage.getItem("Token"), //the token is a variable which holds the token
              },
            }
          )
          .then(({ data }) => {
            resolve(data);
            
            if (data.status.toLowerCase() == "success") {
              this.result = "True";
            }else{
              this.result = "False";
            }
            
          })
          .catch((e) => {
            
            reject(e);
          });
      });
     
    },
  },
};
</script>

<style>
</style>