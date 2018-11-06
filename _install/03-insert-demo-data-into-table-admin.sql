insert into `admin`
  (`login`, `password`, `email`)
values
  ('admin', SHA2(password('123'), 512), 'test@test.com')
