alter table pesanan
add column
status_pesanan varchar(30);

update pesanan
set status_pesanan = 'BAYAR'
where nomor_pesanan > 30;

update pesanan
set status_pesanan = 'PINJAM'
where nomor_pesanan <= 30;