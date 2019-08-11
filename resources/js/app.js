window.Vue = require('vue');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import ContactList from "./components/ContactList";
import AddressesList from "./components/AddressesList";
import EmailsList from "./components/EmailsList";
import PhoneNumbersList from "./components/PhoneNumbersList";
import PersonalCard from "./components/PersonalCard";

const app = new Vue({
    el: '#app',
    components: { ContactList, AddressesList, PersonalCard, EmailsList, PhoneNumbersList },
});
