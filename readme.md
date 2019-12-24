# Lumen PHP Framework
- Add project in Apache root directory (htdocs for xampp or www for wamp)   
- Edit ``.env`` file and configure your database connection.    
- Run ``composer install``
- If you don't have composer installed in your machine, download it from here: https://getcomposer.org/download/         

## Available APIs
### Country
- GET ALL: http://localhost/lumen-test/public/country/ALL  
- GET ID, http://localhost/lumen-test/public/country/1  
- POST: http://localhost/lumen-test/public/country  
- PUT: http://localhost/lumen-test/public/country/8?name=testing  
- DELETE: http://localhost/lumen-test/public/country/8  

### City
- GET ALL: http://localhost/lumen-test/public/city/ALL  
- GET ID, http://localhost/lumen-test/public/city/1  
- POST: http://localhost/lumen-test/public/city  
- PUT: http://localhost/lumen-test/public/city/1?name=Jenin_edited&countryId=2  
- DELETE: http://localhost/lumen-test/public/city/1  

### Address
- GET ALL: http://localhost/lumen-test/public/address/ALL  
- GET ID, http://localhost/lumen-test/public/address/1  
- POST: http://localhost/lumen-test/public/address  
- PUT: http://localhost/lumen-test/public/address/99?title=edited&email=mail@test.ps&telephone=12313  
- DELETE: http://localhost/lumen-test/public/address/1  
