



describe('template spec', () => {

  beforeEach(() => {
    cy.visit('http://localhost:8881/registration')
  })

  describe('Register form', () => {
    it('should register a new user', () => {
      cy.get('input[name="name"]').type('testuser1')
      cy.get('input[name="email"]').type('testuser1@example.com')
      cy.get('input[name="password"]').type('password123')
      cy.get('input[name="password_confirmation"]').type('password123')
      cy.get('form').submit()

    //  cy.url().should('include', '/login')
    })
  })


})