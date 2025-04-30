<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="body-wrapper">
    <header class="app-header">
      @include('layouts.include.navbar')
    </header>

    <table width="100%">
      <tr>
        <td> @include('layouts.include.sidebar') </td>
        <td width="100%">      
        <div class="body-wrapper-inner">
          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
              <form>
                <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="judul" class="form-control" id="judul" placeholder="isi judul.." name="">
                </div>
                <div class="form-group">
                  <label for="konten">Konten</label>
                  <textarea name="" id="" rows="13"></textarea>
                  <input type="konten" class="form-control" id="" placeholder="isi Konten..">
                </div>
                <div class="form-group">
                  <label for="kategori">Kategori</label>
                  <input type="" class="form-control" id="kategori" placeholder="isi Kategori.." name="">
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
    </table>
    <aside>
      
    </aside>
    
</div>

</body>
</html>