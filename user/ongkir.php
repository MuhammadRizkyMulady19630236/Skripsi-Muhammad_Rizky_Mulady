<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <strong class="card-title mb-3">Cek Ongkir</strong>
            </div>
            <div class="card-body">
              <form class="form-horizontal" id="ongkir" method="POST">
                <div class="form-group">
                  <label>Kota Asal</label>
                  <select class="form-control" id="kota_asal" name="kota_asal" required="">
                  </select>
                </div>
                <div class="form-group">
                  <label>Kota Tujuan</label>
                  <select class="form-control" id="kota_tujuan" name="kota_tujuan" required="">
                    <option></option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kurir</label>
                  <select class="form-control" id="kurir" name="kurir" required="">
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">POS INDONESIA</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Berat (Kg)</label>
                  <input type="text" class="form-control" id="berat" name="berat" required="">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-danger btn-block">Cek</button>
                </div>
                <div class="register-link">
                  <p>
                    * API Bye Raja Ongkir
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div id="response_ongkir">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>