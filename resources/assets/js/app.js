
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('chat', require('./components/chat.vue'));

const app = new Vue({
    el: '#app',
    data : {
    	input :'',
    	text : {
            pesan : [],
            user : [],
            color : []
    	}
    },
    methods :{
    	push(){
            this.text.pesan.push(this.input);
            this.text.user.push('you');
            this.text.color.push('kuning');
            axios.post('/push', {
                pesan : this.input,
                textsession : this.text
            })
            .then(response => {
                this.input = ' '
            });
    	},
        textsession(){
            axios.post('/textsession')
            .then(response => {
                if (response.data != ''){
                    this.text = response.data;
                }
            })
            .then(response => { 
                console.log(response)
            })
            .catch(error => {
                console.log(error.response)
            });
        }
    },
    mounted(){
        this.textsession();
        Echo.private('chat')
        .listen('Event', (e) => {
            this.text.pesan.push(e.pesan);
            this.text.user.push(e.user);
            this.text.color.push('hijau');

                axios.post('/ChatSession',{
                    textsession : this.text
                })
        });
    }
});
