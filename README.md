#Tea-Messenger-Web
---
#####Tools :
- Git
- Composer
- Text Editor (Nodepad++, VSCode, Vim, etc)
- PHP v.7.x

#####Pull/Menarik Repositori :
- `git init Tea-Messenger-Web && cd Tea-Messenger-Web`
- `git remote add origin https://github.com/TeaInside/Tea-Messenger-Web.git`
- `git pull origin master`

#####Buat Branch :
- agar tidak mengganggu branch utama `master` lebih baik jika membuat branch sendiri untuk melakukan pengeditan sebelum di `push` ke branch utama `master`
- `git branch <nama-branch-baru>`
- `git checkout <nama-branch-baru>`

#####Push/Upload:
- `git add .` atau `git add -A`
- `git commit -m "<pesan>"` contoh `git commit -m "bagusin header"`
- `git push` atau `git push origin <nama-branch>`

#####Pull Request :
- jika yang dikerjakan di branch sudah stabil atau tidak ada bug, bisa dilakukan <b>Pull Request</b> dari branch yang baru ke branch utama `master`
- `git add .`
- `git commit -m "<pesan>"`
- `git checkout master`
- `git pull origin master`
- buka halaman `https://github.com/TeaInside/Tea-Messenger-Web.git` dan klik `membuat pull request`

#####Penggunaan :
- `composer install --verbose`
- run service `php icetea serve`

---
Tea Inside Team