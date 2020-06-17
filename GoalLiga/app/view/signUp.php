<!-- Body of the HTML page -->
<!-- Container4 div -->
<div class="container4">
  <!-- PHP codes that checks form validation -->
  <div class="alert">
      <a></a>
  </div>
  <!-- User account creation submission form -->
  <form id = "signUp" name = "userAccount" class="postStory">
    <span>Username: </span>
    <textarea id = "un" name="username" rows="1" cols="80" placeholder="Username" class = "submitInfo"></textarea>
    <br>
    <span>Password: </span>
    <textarea id = "pw" name="password" rows="1" cols="80" placeholder="Password" class = "submitInfo"></textarea>
    <span>E-mail: </span>
    <textarea id = "email" name="email" rows="1" cols="80" placeholder="e-mail" class="submitInfo"></textarea>
    <br>
    <div class="favoriteClub">
      <span>Favorite Club:</span>
      <select id = "club" class="clublist" name="clubs">
        <option value="Real Madrid">Real Madrid</option>
        <option value="FC Barcelona">Barcelona</option>
        <option value="Atletico Madrid">Atletico Madrid</option>
      </select>
    </div>
    <br>
    <span>First Name:</span>
    <textarea id = "firstName" name="firstName" rows="1" cols="80" placeholder="First Name" class="submitInfo"></textarea>
    <br>
    <span>Last Name:</span>
    <textarea id = "lastName" name="lastName" rows="1" cols="80" placeholder="Last Name" class="submitInfo"></textarea>
    <br>
  </form>
  <button id="createAccountBtn">Create Account</button>
  <div class="clearFix">
  </div>
</div>
