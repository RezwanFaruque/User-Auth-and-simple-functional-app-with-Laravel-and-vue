<template>
  <div id="registration_form">
    <div class="page-title text-center">Registration Page</div>
    <div class="form-section">
      <ValidationObserver v-slot="{ invalid }">
        <form @submit.prevent="registerUser">
          <div class="section">
            <ValidationProvider rules="required" v-slot="{ errors }">
              <input
                :class="{
                  firstname: true,
                  error: errors.length > 0,
                }"
                type="text"
                placeholder="First Name"
                v-model="formData.firstname"
              />
              <span id="error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>

          <div class="section">
            <ValidationProvider rules="required" v-slot="{ errors }">
              <input
                :class="{
                  lastname: true,
                  error: errors.length > 0,
                }"
                type="text"
                placeholder="Last Name"
                v-model="formData.lastname"
              />
              <span id="error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>

          <div class="section">
            <ValidationProvider rules="required" v-slot="{ errors }">
              <input
                :class="{
                  phonenumber: true,
                  error: errors.length > 0,
                }"
                type="text"
                placeholder="Phone Number"
                v-model="formData.phonenumber"
              />
              <span id="error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>

          <div class="section">
            <ValidationProvider rules="required" v-slot="{ errors }">
              <input
                :class="{
                  email: true,
                  error: errors.length > 0,
                }"
                type="email"
                placeholder="Email"
                v-model="formData.email"
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
                type="password"
                placeholder="Password"
                v-model="formData.password"
                ref="password"
              />
              <span id="error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>

          <div class="section">
            <ValidationProvider
              rules="required|confirmed:confirmation"
              v-slot="{ errors }"
            >
              <input
                :class="{
                  confirmpassword: true,
                  error: errors.length > 0,
                }"
                type="password"
                placeholder="Confirm Your Password"
                v-model="formData.confirmpassword"
              />
              <span id="error">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>

          <div class="login-submit">
            <button :disabled="invalid" type="submit" class="button-submit">
              Sign up
            </button>
          </div>
        </form>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
import {
  ValidationProvider,
  ValidationObserver,
} from "vee-validate/dist/vee-validate.full.esm";

import axios from 'axios';
export default {
  name: "Registration",
  components: {
    ValidationObserver,
    ValidationProvider,
  },

  data: function () {
    return {
      formData: {
        firstname: "",
        lastname: "",
        phonenumber: "",
        email: "",
        password: "",
        confirmpassword: "",
      },
    };
  },

 methods:{
   async registerUser(){
     return new Promise((resolve, reject) => {
        axios
          .post('http://127.0.0.1:8000/api/register', this.formData)
          .then(({ data }) => {
            resolve(data);
            console.log(data);
            if(data.status.toLowerCase() == 'success'){
              this.formData.firstname = "",
              this.formData.lastname = "",
              this.formData.phonenumber = "",
              this.formData.email = "",
              this.formData.password = "",
              this.formData.confirmpassword = "",
              

              this.$router.push("/");
            }
          })
          .catch((e) => {
            console.log(e)
            reject(e);
          });
      })
   }
 }


};
</script>

<style>
</style>