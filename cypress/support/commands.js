// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

/*
Cypress.Commands.add('setupDatabase', () => {
    cy.exec(`docker exec app php artisan migrate:fresh --seed --env=cypress`);
});
*/

Cypress.Commands.add('npmRunDev', () => {
    cy.exec(`npm run dev`);
});


Cypress.Commands.add('setupDatabase', () => {
    cy.exec(`docker exec app php artisan migrate:fresh --env=cypress`);
    cy.exec(`docker exec app php artisan db:seed --class=DatabaseSeederTesting --env=cypress`);
});


Cypress.Commands.add('seed', (seeder) => {
    cy.exec(`docker exec app php artisan db:seed --class=${seeder} --env=cypress`);
});
