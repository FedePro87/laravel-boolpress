require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';

window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import App from './components/App';

function init() {
  var token = $('meta[name="csrf-token"]').attr('content');
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
  // render(<App />, document.getElementById('app'));
  $('.alert').fadeOut(5000);

  Vue.component('post-card', {
    template:"#post-card",
    props: {
      postId : String,
      title: String,
      content: String,
      author:String,
      likes: String
    },
    data:function(){
      return {
        liked:false,
        deleted:false,
        editField:'',
        postTitle:this.title,
        postContent:this.content
      };
    },
    computed: {
      heartIcon: function(){
        return this.liked ? "fas" : "far";
      },
      postLike: function(){
        var tmpLikes=Number(this.likes) + (this.liked ? 1 : 0);
        return tmpLikes;
      }
    },
    methods: {
      setLiked: function(){
        this.liked=!this.liked;
        console.log(this.liked);
      },
      focusField(name){
        this.editField=name;
      },
      showField(name){
        return this.editField==name;
      },
      deletePost:function(){
        axios.delete('/post/destroy/' + this.postId)
             .then((response)=>{
               console.log(response.data);
             }).catch((error)=>{
               console.log(error.response.data);
             });

        this.deleted=true;
      },
      updatePost(){
        var post={
          _token:token,
          title:this.postTitle,
          content:this.content,
          author:this.author
        }

        axios.post('/post/update/' + this.postId,post)
             .then((response)=>{
               console.log(response.data);
               console.log(response.status);
             }).catch((error)=>{
               console.log(error.response.data);
             });

        this.editField='';
      },
      reverseMessage: function () {
        if (this.content[0]=="<") {
          var splittedContent=this.content.split('<h1>');
          var splittedContentClosure=splittedContent[1].split('</h1>');
          this.content=splittedContentClosure[0].split('').reverse().join('');
        } else {
          this.content = this.content.split('').reverse().join('');
        }
      },
      showPost(){
        window.location.href = "post/"+this.postId;
      }
    }
  });

  new Vue({
    el:"#component-vue"
  });
}

$(document).ready(init);
