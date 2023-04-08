
describe('Content page', () => {
    beforeEach(() => {
      cy.visit('http://localhost:8881/contents')
    })
    
    it('displays contents', () => {
      cy.get('#cards').should('have.length.greaterThan', 0)
    })
    
    it('displays loading spinner', () => {
      cy.intercept('GET', 'http://localhost:8881/api/contents', {
        statusCode: 200,
        }).as('getContent');
    
      cy.visit('http://localhost:8881/contents')
      
      cy.get('#loading-spinner').should('be.visible')
      
      cy.wait('@getContent')
      
      cy.get('#loading-spinner').should('not.exist')
    })
    
    it('displays no results message', () => {
      cy.intercept('GET', 'http://localhost:8881/api/contents?search=nonexistent', {
        statusCode: 200,
        body: { data: [] }
      }).as('getNoResults')
    
      cy.visit('http://localhost:8881/contents?search=nonexistent')
      
      cy.get('#no-result').contains('Nincs találat')
    })
    
    it('searches for content', () => {
      cy.intercept('GET', 'http://localhost:8881/api/contents?search=example', {
        statusCode: 200,
      }).as('getSearchResults')
    
      cy.get('.form-control').type('example')
      
      cy.get('.form-control').type('{enter}')
      
      cy.wait('@getSearchResults')
      
      cy.get('#cards').should('have.length.greaterThan', 0)
      
      cy.get('.text-center').contains('Keresési találatok: example')
    })
    
    it('navigates to create content page', () => {
      cy.get('.fab-button').click()
      
      cy.url().should('include', 'http://localhost:8881/create/content')
    })
})