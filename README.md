## Introduction


Hello! My name is Gabriel, but so many people know me as TheZergLord or TZL. I'm a brazilian Starcraft 2 ex-pro player and now a junior developer.
I decided to create this project just for studies and fun purposes, where I start to learn how to use APIs in general and how to use Laravel for manage it.

### About the project

Basically this is an application that get the Grandmaster League player list from the Battle.net API endpoint and show this list for the user.
It works getting the player list from the endpoint, storing in the database (every 10 minutes) and getting back these player list from the database to the frontend.

## Quick Start

After clone this project in your local storage, you need to do the following steps:

- Access the [Battle.net Client Management Page](https://develop.battle.net/access/clients), log in with your Battle.net account and create a Client;
- Create a copy of the file .env.example, located in the root directory of the project, and rename the copy to only ".env";
- Open the .env file, and add a new line on it with "BATTLE_NET_CLIENT_ID={your Client ID}" and other line with "BATTLE_NET_CLIENT_SECRET={your Client Secret};
- Create a new file in the root directory of the project with the name "bnetAPIToken.key".

