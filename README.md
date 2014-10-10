# RabbitMQ PHP 

This is a simple PHP app that uses RabbitMQ. 

## Prerequisites
- If you do not have an HP Helion Development Platform Application Lifecycle 
  Services Cluster available, please create one before continuing. You will also
  need to install the Helion CLI.  
- Make sure that the RabbitMQ service is enabled. It is not enabled by default. 
    - Go to the Management Console (e.g. https://api.example.com)
    - Admin --> Cluster --> Settings (gear icon on right corner) --> Check off 
      Rabbit3 --> Save
- You will need [Composer] (https://getcomposer.org/) to install the dependencies. 
  Simply run the following command to install dependencies:
  
    `composer install`    
    
## Deploy the Application

To deploy the application, make sure you have the Helion CLI/client installed. 
Execute the following commands:

- Open the terminal
- If you are not already there, *cd* to the root directory of the sample. The 
  root directory contains the manifest.yml file which helps automate deployment. 
- If you have not logged in to your target environment yet, execute the following:

    `helion target https://api.example.com`
    
    `helion login`
    
    Enter your Management Console credentials
    
    `helion push -n`

## View and run the app
- Go to the Management Console (e.g. https://api.example.com)
- Check the applications link to see a list of your apps.
- Click on the name of the app you just deployed. The app name is specified in 
  manifest.yml.
- Click "View App" to see your app in action.

The result when visiting the application page and clicking 'View App' should be
a page that will accept a user's message.
