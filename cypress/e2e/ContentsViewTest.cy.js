//import App from '.../resources/App.vue'



describe('asd', () => {

  beforeEach(() => {
    cy.visit('http://localhost:8881/')
  })


  it('visits', () => {
    cy.url().should('include', 'http://localhost:8881/')
  })
})

describe('Content page', () => {
    beforeEach(() => {
    cy.visit('http://localhost:8881/contents')
    })
    
    it('displays contents', () => {
      cy.get('.cards').should('have.length.greaterThan', 0)
    })
    
    it('displays loading spinner', () => {
      cy.intercept('GET', 'http://localhost:8881/api/contents', {
    delay: 2000,
    fixture: 'content.json'
    }).as('getContent')
    
    cy.visit('http://localhost:8881/contents')
    
    cy.get('.spinner-border').should('be.visible')
    
    cy.wait('@getContent')
    
    cy.get('.spinner-border').should('not.exist')
    })
    
    it('displays no results message', () => {
    cy.intercept('GET', 'http://localhost:8881/api/contents?search=nonexistent', {
    statusCode: 200,
    body: { data: [] }
    }).as('getNoResults')
    
    cy.visit('http://localhost:8881/contents?search=nonexistent')
    
    cy.get('.text-center').contains('Nincs találat')
    })
    
    it('searches for content', () => {
    cy.intercept('GET', 'http://localhost:8881/api/contents?search=example', {
    statusCode: 200,
    fixture: 'content.json'
    }).as('getSearchResults')
    
    cy.get('.form-control').type('example')
    
    cy.get('.form-control').type('{enter}')
    
    cy.wait('@getSearchResults')
    
    cy.get('.card').should('have.length.greaterThan', 0)
    
    cy.get('.text-center').contains('Keresési találatok: example')
    })
    
    it('navigates to create content page', () => {
    cy.get('.fab-button').click()
    
    cy.url().should('include', 'http://localhost:8881/create/content')
    })
  })