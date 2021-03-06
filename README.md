# RabbitMQ PHP 

This version of the app uses a buildpack that is suitable for the HP Helion
Development Platform v1.3. Please check the 1.0 branch if you are using v1.0.

This is a simple PHP app that uses RabbitMQ. 

New users should check out the resources available at [HP Helion Docs](http://docs.hpcloud.com/helion/devplatform/workbook/messaging/php/). 
The site includes more detail and has instructions on how to create an HP
Helion Development Platform Application Lifecycle Services Cluster.

This app uses the [Cloud Foundry PHP buildpack](https://github.com/cloudfoundry/php-buildpack)

To ensure that your PHP applications continue to perform as expected, it is
advisable to use a stable branch or tagged release of a buildpack. For example,
the manifest.yml could specify a specific tagged release with the following:

`buildpack: https://github.com/cloudfoundry/php-buildpack#v3.2.2`

## Prerequisites
- If you do not have an HP Helion Development Platform Application Lifecycle 
  Services Cluster available, please create one before continuing. You will also
  need to install the Helion CLI, which can be installed from the cluster's
  Management Console. Please refer to [HP Helion Docs](http://docs.hpcloud.com/helion/devplatform/workbook/messaging/php/)
  for further details.  
- Make sure that the RabbitMQ service is enabled. It is not enabled by default. 
  You can take the following steps to enable it:
    - Go to the Management Console (e.g. https://api.example.com)
    - Admin --> Cluster --> Settings (gear icon on right corner) --> Check off 
      Rabbit3 --> Save

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
    
    `helion push`

    Hit enter to accept any default values that you may be prompted for. 
    Note: By default, ALS clusters are configured with two domains (private and
    public). In some situations, the Helion CLI may prompt you to select a target
    domain. If prompted, select the public domain from the given list (e.g. https://api.example.com)

## View and run the app
- Go to the Management Console (e.g. https://api.example.com)
- Check the applications link to see a list of your apps.
- Click on the name of the app you just deployed. The app name is specified in 
  manifest.yml.
- Click "View App" to see your app in action.

The result when visiting the application page and clicking 'View App' should be
a page that will accept a user's message.
