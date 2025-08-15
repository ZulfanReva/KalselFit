Flow Repository Service Pattern:
User -> Controller -> Service (Memanggil method yang di request oleh user)-> Repository Interface (Contract)-> (Dieksekusi) Repostitory (Implementation) (Karena ada menggunakan implements dari file contract) -> Dikembalikan ke controller
