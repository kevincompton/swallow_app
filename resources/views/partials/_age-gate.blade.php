<div v-show="show" id="age-gate">
  <section class="modal">
  <img src="/images/logo/logo.png" />
    <div class="copy">
      <h1 class="heading">Welcome!</h1>
      <p>You must verify your age before entering</p>
      <h1 class="message" v-if="deny == false">Are you 21 or over?</h1>
      <h1 class="message" v-else>You must be 21 or over to enter.</h1>

      <div v-show="deny == false" class="actions">
        <button v-on:click="cancel()">No</button>
        <button v-on:click="confirm()">Yes</button>
      </div>
    </div>
  </section>
</div>