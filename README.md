# Sistem Booking

## Developer Guideline

### Database UML
Silakan dilihat `/bookshit.wmb` untuk db-uml design.

### Directory Structure
Design directory sepenuhnya mengikuti standard [Yii Framework](http://www.yiiframework.com), silakan dibaca panduannya [disini](http://www.yiiframework.com/doc/).

### Controllers and Actions Definition
Catatan:  
1. Controller yang tidak didefinisikan disini berarti tidak digunakan.
2. Action yang didefinisikan tidak menggunakan prefix `action` mis. `actionBrowse` menjadi `browse`.

* `AccountController`
```
  create:
  update:
  delete:
  manage:
    Fungsi umum, silakan dibaca langsung di codebase.
  login:
  logout:
    Log Handler.
  error:
    Display common app error.
  sales:
    Menampilkan sales account yang (seingat saya) beberapa form akan melakukan http async query ke action ini seperti (booking|request)/(create|update)
```

* `BookingController`
```
  create:
  update:
  delete:
  manage:
    Fungsi umum, silakan dibaca langsung di codebase.
```

* `CompanyController`
```
  create:
  update:
  delete:
  manage:
    Fungsi umum, silakan dibaca langsung di codebase.
  relate:
	Melakukan sync data client ke database oracle sisko.
```

* `RequestController`
```
  create:
  update:
    Dipanggil secara async oleh BookingController:(create|update)
  browse:
  manage:
    Dipanggil secara async oleh BookingController:(browse|manage)
```

### Models
Model dengan prefix `Comm` digunakan langsung oleh aplikasi sebagai sarana penyimpanan dan pengolahan data. Berbeda dengan model tanpa prefix `Comm` yang kebayakan hanya digunakan sebagai *bridge* ke database sisko (oracle).

#### Common Relations
Beberapa relasi tidak didefinisikan secara eksplisit, melaikan hanya singkatan yg terdiri dari beberapa karakter. Silakan dibaca di method `relations` setiap *Model Class* untuk lebih jelasnya.

#### Common Methods
```
get{Type}List:
get{Type}Name:
```
Biasanya digunakan untuk menampilkan value dari constants yang memiliki prefix sejenis.
Misal:
```
const WARNA_MERAH = 1;
const WARNA_HIJAU = 2;

getWarnaList();
getWarnaName($id);
```

Selain yang didefinisikan, methods tersebut merupakan method yang digunakan oleh Yii. Silakan dibaca manualnya.

#### Definition
*To be continue...*