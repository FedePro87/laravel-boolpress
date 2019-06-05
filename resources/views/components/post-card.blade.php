<script type="text/x-template" id="post-card">
  <div class="post-card">
    <h3>@{{title}}</h3>
    <div class="post-content">
      <p v-html="content"></p>
    </div>
    <div class="user-wrapper d-flex">
      <div class="user-logo-wrapper">
        <img src="{{asset('img/person.png')}}" alt="">
      </div>
      <span>@{{author}}</span>
    </div>
    <!-- <button v-on:click="reverseMessage">Reverse Message</button> -->
  </div>
</script>
