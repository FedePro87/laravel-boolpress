<script type="text/x-template" id="post-card">
  <div class="post-card" v-show="!deleted">
    <h3 @click="focusField('title')" v-show="!showField('title')">@{{postTitle}}</h3>
    <input type="text" v-show="showField('title')" v-model="postTitle">
    <i class="fas fa-share" @click="updatePost()" v-show="showField('title')"></i>
    <i class="fas fa-trash-alt" @click="deletePost()" v-show="!showField('title')"></i>
    <div class="post-content">
      <p v-html="content" @click="focusField('content')" v-show="!showField('content')"></p>
      <textarea v-show="showField('content')" rows="4" cols="23" v-model="postContent"></textarea>
    </div>
    <div class="user-wrapper d-flex">
      <div class="user-logo-wrapper">
        <img src="{{asset('img/person.png')}}" alt="">
      </div>
      <span>@{{author}}</span>
    </div>
    <div @click="setLiked()">
      <strong>@{{postLike}}</strong>
      <i class="fa-heart" v-bind:class="heartIcon"></i>
    </div>
    <!-- <button v-on:click="reverseMessage">Reverse Message</button> -->
  </div>
</script>
