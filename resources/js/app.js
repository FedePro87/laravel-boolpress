require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';

window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import App from './components/App';

function init() {
  // render(<App />, document.getElementById('app'));
  $('.alert').fadeOut(5000);

  Vue.component('post-card', {
    template:"#post-card",
    props: {
      title: String,
      content: String,
      author:String
    }
  });

  new Vue({
    el:"#component-vue"
  });

  $(document).on('click','.post-card',function(){
    var id=$(this).data('id');
    window.location.href = "/post/" + id;
  })
}

$(document).ready(init);
