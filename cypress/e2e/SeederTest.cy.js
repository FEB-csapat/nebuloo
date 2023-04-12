
describe('My test', () => {
    it('should run the migrations and seeders', () => {
      cy.setupDatabase();
    });
  });

/*
describe('My test', () => {
    it('should seed the database', () => {
        cy.seed('MySeeder');
    });
});
*/