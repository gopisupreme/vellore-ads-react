# Security clean-up

Found while moving the site into this repository (September 2026). The fixes
are in the code here; the **live server still has the problems** until the
new code is uploaded and the files below are deleted there.

## 1. Injected code (malware)

Obfuscated JavaScript that loads a script from another server was added to
the site's own files. Removed here:

| File | Change |
| --- | --- |
| `assets/js/custom.js` | injected line removed (the rest of the file is the site's code) |
| `assets/js/datatables.js` | injected block at the start removed |
| `assets/js/sw.js` | deleted (only the injected code) |
| `assets/js/bootstrapold.js` | deleted (unused copy, infected) |
| `assets/js/angular.old.min.js` | deleted (unused copy, infected) |

138 small `index.php` files that send visitors to `https://wozoshop.com/`
were placed in many folders (including `system/` and `application/libraries/`).
All of them are deleted here; the list is at the end of this file.

**On the live server:** upload the cleaned files, delete the files listed,
and check for other changes (file dates around the injection, unknown PHP
files in upload folders). Change the hosting, FTP and database passwords.

## 2. Exposed password

`products/database_connection.php` contained the live database password in
plain text, and it is in the old repository's git history. It now reads
`app/config.php`. **Change the database password.**

## 3. Security holes fixed in the code

* Admin pages (`connect/…`) were open to any signed-in user; now admins only.
* `connect/admin_setting_edit` wiped the company settings when opened by a
  link; `premiumAdd`, `premiumEdit`, `adsTypeAdd` saved blank rows the same way.
  They now only save a submitted form.
* `connect/excel_import` and `connect/excel_location` (bulk upload of
  listings / locations) had no sign-in check at all.
* `users/db_listing_delete/<id>` let anyone, even not signed in, delete any listing.
* Listing / matrimony / spa / post edits, products, orders, reviews, shop
  categories / brands / sub categories: any signed-in user could change or
  delete other users' entries. Now only the owner.
* `users/action_profile`: the form's hidden user id decided which account was
  changed (account takeover). Now always the signed-in user.
* Claim business: an empty OTP matched listings that never had one. Now a
  real OTP, for the business chosen in step 1.
* Passwords and tokens were sent to the browser with the user's data. Not any more.
* Lead management showed every enquiry of the whole site to every owner. Now
  only enquiries about the owner's own listings.
* A profile photo upload could delete the shared `default.png` avatar.

Still to review: passwords are stored in plain text in `users.u_password`
(they should be hashed); many old queries build SQL from request values.

## Deleted redirect files

- `products/images/listing/index.php`
- `products/images/services/index.php`
- `system/database/drivers/pdo/subdrivers/index.php`
- `system/database/drivers/mysqli/index.php`
- `application/libraries/PHPExcel/Reader/index.php`
- `application/libraries/PHPExcel/locale/it/index.php`
- `application/libraries/PHPExcel/locale/cs/index.php`
- `application/libraries/PHPExcel/Reader/Excel5/index.php`
- `application/libraries/PHPExcel/Reader/Excel5/Color/index.php`
- `application/libraries/PHPExcel/Reader/Excel5/Style/index.php`
- `application/libraries/PHPExcel/locale/pl/index.php`
- `application/libraries/PHPExcel/locale/da/index.php`
- `application/libraries/PHPExcel/Reader/Excel2007/index.php`
- `application/libraries/PHPExcel/locale/index.php`
- `application/libraries/PHPExcel/locale/sv/index.php`
- `application/libraries/PHPExcel/locale/ru/index.php`
- `application/libraries/PHPExcel/locale/pt/index.php`
- `application/libraries/PHPExcel/locale/de/index.php`
- `application/libraries/PHPExcel/locale/fi/index.php`
- `application/libraries/PHPExcel/locale/nl/index.php`
- `application/libraries/PHPExcel/locale/pt/br/index.php`
- `application/libraries/PHPExcel/locale/no/index.php`
- `application/libraries/PHPExcel/locale/tr/index.php`
- `application/libraries/PHPExcel/locale/fr/index.php`
- `application/libraries/PHPExcel/Worksheet/index.php`
- `application/libraries/PHPExcel/locale/hu/index.php`
- `application/libraries/PHPExcel/locale/en/index.php`
- `application/libraries/PHPExcel/locale/bg/index.php`
- `application/libraries/PHPExcel/locale/es/index.php`
- `application/libraries/PHPExcel/Worksheet/Drawing/index.php`
- `application/libraries/PHPExcel/locale/en/uk/index.php`
- `application/libraries/PHPExcel/Worksheet/AutoFilter/Column/index.php`
- `application/libraries/PHPExcel/Chart/index.php`
- `application/libraries/PHPExcel/Worksheet/AutoFilter/index.php`
- `application/libraries/PHPExcel/Shared/index.php`
- `application/libraries/PHPExcel/Chart/Renderer/index.php`
- `application/libraries/PHPExcel/Style/index.php`
- `application/libraries/PHPExcel/Shared/OLE/index.php`
- `application/libraries/PHPExcel/Shared/trend/index.php`
- `application/libraries/PHPExcel/Shared/JAMA/index.php`
- `application/libraries/PHPExcel/Shared/Escher/DggContainer/BstoreContainer/index.php`
- `application/libraries/PHPExcel/Shared/JAMA/utils/index.php`
- `application/libraries/PHPExcel/Shared/Escher/DggContainer/BstoreContainer/BSE/index.php`
- `application/libraries/PHPExcel/Shared/OLE/PPS/index.php`
- `application/libraries/PHPExcel/Shared/Escher/index.php`
- `application/libraries/PHPExcel/Shared/Escher/DgContainer/index.php`
- `application/libraries/PHPExcel/Shared/PCLZip/index.php`
- `application/libraries/PHPExcel/Shared/Escher/DggContainer/index.php`
- `application/libraries/PHPExcel/Shared/Escher/DgContainer/SpgrContainer/index.php`
- `application/libraries/PHPExcel/Cell/index.php`
- `application/libraries/PHPExcel/Calculation/index.php`
- `application/libraries/PHPExcel/Calculation/Token/index.php`
- `application/libraries/PHPExcel/Writer/index.php`
- `application/libraries/PHPExcel/Writer/Excel5/index.php`
- `application/libraries/PHPExcel/Writer/OpenDocument/index.php`
- `application/libraries/PHPExcel/RichText/index.php`
- `application/libraries/PHPExcel/CalcEngine/index.php`
- `application/libraries/PHPExcel/Helper/index.php`
- `application/libraries/PHPExcel/CachedObjectStorage/index.php`
- `application/language/english/index.php`
- `assets/images/post-data/index.php`
- `assets/images/sliders/index.php`
- `matrimony_html/images/sm/index.php`
- `matrimony_html/images/room/index.php`
- `matrimony_html/images/how/index.php`
- `matrimony_html/images/mail/index.php`
- `matrimony_html/images/slider/index.php`
- `matrimony_html/images/users/index.php`
- `matrimony_html/images/menu/index.php`
- `matrimony_html/images/icon/index.php`
- `matrimony_html/images/listing/index.php`
- `matrimony_html/images/services/index.php`
- `matrimony_html/images/list-deta/index.php`
- `vlrbk/tourism/images/index.php`
- `vlrbk/tourism/images/slider/index.php`
- `vlrbk/tourism/images/users/index.php`
- `vlrbk/tourism/images/services/index.php`
- `vlrbk/tourism/development/js/index.php`
- `vlrbk/tourism/fonts/index.php`
- `vlrbk/application/libraries/PHPExcel/Reader/index.php`
- `vlrbk/application/libraries/PHPExcel/Reader/Excel5/Color/index.php`
- `vlrbk/application/libraries/PHPExcel/Reader/Excel5/index.php`
- `vlrbk/application/libraries/PHPExcel/Reader/Excel5/Style/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/pl/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/da/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/no/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/it/index.php`
- `vlrbk/application/libraries/PHPExcel/Reader/Excel2007/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/ru/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/sv/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/hu/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/cs/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/de/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/pt/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/nl/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/pt/br/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/fi/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/en/uk/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/bg/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/fr/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/es/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/tr/index.php`
- `vlrbk/application/libraries/PHPExcel/locale/en/index.php`
- `vlrbk/application/libraries/PHPExcel/Worksheet/index.php`
- `vlrbk/application/libraries/PHPExcel/Worksheet/AutoFilter/Column/index.php`
- `vlrbk/application/libraries/PHPExcel/Worksheet/Drawing/index.php`
- `vlrbk/application/libraries/PHPExcel/Chart/index.php`
- `vlrbk/application/libraries/PHPExcel/Worksheet/AutoFilter/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/index.php`
- `vlrbk/application/libraries/PHPExcel/Chart/Renderer/index.php`
- `vlrbk/application/libraries/PHPExcel/Style/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/trend/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/OLE/PPS/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/JAMA/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/JAMA/utils/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/Escher/DgContainer/SpgrContainer/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/OLE/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/Escher/DggContainer/BstoreContainer/BSE/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/Escher/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/Escher/DggContainer/BstoreContainer/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/Escher/DgContainer/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/Escher/DggContainer/index.php`
- `vlrbk/application/libraries/PHPExcel/Shared/PCLZip/index.php`
- `vlrbk/application/libraries/PHPExcel/Calculation/index.php`
- `vlrbk/application/libraries/PHPExcel/Cell/index.php`
- `vlrbk/application/libraries/PHPExcel/Calculation/Token/index.php`
- `vlrbk/application/libraries/PHPExcel/Writer/index.php`
- `vlrbk/application/libraries/PHPExcel/Writer/PDF/index.php`
- `vlrbk/application/libraries/PHPExcel/Writer/OpenDocument/index.php`
- `vlrbk/application/libraries/PHPExcel/Writer/Excel5/index.php`
- `vlrbk/application/libraries/PHPExcel/Writer/OpenDocument/Cell/index.php`
- `vlrbk/application/libraries/PHPExcel/Writer/Excel2007/index.php`
- `vlrbk/application/libraries/PHPExcel/RichText/index.php`
- `vlrbk/application/libraries/PHPExcel/Helper/index.php`
- `vlrbk/application/libraries/PHPExcel/CalcEngine/index.php`
- `vlrbk/application/libraries/PHPExcel/CachedObjectStorage/index.php`
- `vlrbk/application/language/english/index.php`
