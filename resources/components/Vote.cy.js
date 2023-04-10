import Vote from './Vote.vue'

describe('<Vote />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
    cy.mount(Vote)
  })
})

/*

describe('Vote component', () => {
  it('should toggle upvote', () => {
    cy.mount(Vote, {
      propsData: {
        contentId: 1,
        vote: { direction: 0 },
        voteCount: 5,
      },
    });
    cy.get('#upvote').click();
    cy.get('#votecount').should('have.text', '6');
  });

  it('should toggle downvote', () => {
    cy.mount(Vote, {
      propsData: {
        contentId: 1,
        vote: { direction: 0 },
        voteCount: 5,
      },
    });
    cy.get('#downvote').click();
    cy.get('#votecount').should('have.text', '4');
  });
});
*/