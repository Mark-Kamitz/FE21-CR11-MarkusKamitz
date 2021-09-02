
# FE21-CR11-MarkusKamitz

![CRUD with user management](https://user-images.githubusercontent.com/85449060/131910613-c8632ac5-e221-4a5a-8b10-c269683944dd.png)

## CodeReview 11

**Project description: “Adopt a Pet”**

* You love animals and think it is time to adopt one. You like all sorts of animals: small animals, large animals, you may even like reptiles and birds and may be open to adopting animals of any age. 

* Let's then create an animal adoption platform to connect users (people interested in adopting pets) and animals (pets interested in being adopted). 

* All users must introduce their first_name and last_name, email, phone_number, address, picture and password in order to register on the platform.

* All animals must have a name, a photo and live at a specific location(a single line like “Praterstrasse 23” is enough). They also have a description, size, age, hobbies and belong to a breed.

* For the regular points of this CodeReview, you need to create a structure using PHP and MySQL (apart from HTML, CSS, JS, etc) that will display the relevant data of the animals.

 

**Project Naming:**

* Create a GitHub Repository named: FE21-CR11-YourName. Push the files into it and send the link through the learning management system (LMS). Set your repository to private. Add codefactorygit as a collaborator. See an example of a GitHub link below:

https://github.com/JohnDoe/repositoryname.git.

* Your MySQL database MUST be named: fswd13_cr11_petadoption_yourname

### For this CodeReview, the following criteria will be graded:

 
* (5) Create a database ( fswd13_cr11_petadoption_yourname) initially with 2 tables: users and animals. Add sufficient test data in the animals table: at least 10 records in total between small animals and large animals. Remember that animals have their age so make sure there are at least 4 senior animals in the DB (older than 8 years old).

* (20) Display all animals on a single web page (home.php). Make sure a nice GUI is presented here(backenders exempt)

* (15) Display all senior animals. Here you can decide whether to create a filter on the home page or create a new page senior.php

* (15) Create a show more/show details button that will lead to a new page with only the information from that specific record/animal.

* (15) Create a registration and login system.

* Create separate sessions for normal users and administrators.

* (15)Normal Users:

* They will be able to ONLY see(read) and access all data. No action buttons (create, edit or delete) should be available.

* (15) Admin:

* Only the admin is able to create, update and delete data about animals (not users) within the admin panel, therefore an Admin Panel/Dashboard  should be created.

**Bonus points**

* (20)Pet Adoption

* In order to accomplish this task, a new table pet_adoption will need to be created. This table should hold the userId and the petId (as foreign keys) plus other information that you may think is relevant i.e: adoption_date. 

* Each Pet information/card should have a button "Take me home" that when clicked, will "adopt" the pet. When it does, a new record should be created in the table pet_adoption.

* Hint: if you use the POST method to create the adoption, you will need a form. Get method won't need it. You can expand on it creating a status for the pet and it only shows to be adopted according to its status. Not required though.
