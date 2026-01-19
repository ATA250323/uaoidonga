  <div class="card my-4">
      <div class="container-fluid">

          <label class="form-label">Nom</label>
          <div class="input-group input-group-outline col-md-2 mb-3">
              <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" required>
          </div>
          <label class="form-label">Email</label>
          <div class="input-group input-group-outline col-md-2 mb-3">
              <input type="text" class="form-control" name="email" value="{{ $user->email ?? '' }}" required>
          </div>
          <label class="form-label">Mot de passe</label>
          <div class="input-group input-group-outline col-md-2 mb-3">
              <input type="text" class="form-control" name="password" value="{{ $user->password ?? '' }}" required>
          </div>
          <label class="form-label">Confirmer</label>
          <div class="input-group input-group-outline col-md-2 mb-3">
              <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" required>
          </div>
          <label class="form-label">Role</label>
          <div class="input-group input-group-outline col-md-2 mb-3">
              <input type="text" class="form-control" name="name" value="{{ $role->name ?? '' }}" required>
          </div>
          <center><button type="submit" class="btn btn-info">Enregistrer</button></center>
      </div>
  </div>
