export interface BlogPost {
  id: number;
  title: string;
  excerpt: string;
  content: string;
  image: string;
  date: string;
  author: {
    name: string;
    avatar: string;
  };
  category: string;
  slug: string;
}

export const useBlogData = () => {
  const blogs: BlogPost[] = [
    {
      id: 1,
      title: 'UX review presentations',
      excerpt: 'How do you create compelling presentations that wow your colleagues and impress your managers?',
      content: `How do you create compelling presentations that wow your colleagues and impress your managers? This comprehensive guide will walk you through the entire process of creating effective UX review presentations.

## Understanding Your Audience

Before diving into the design, it's crucial to understand who you're presenting to. Are they stakeholders, fellow designers, or developers? Each audience requires a different approach and level of detail.

## Structure Your Presentation

A well-structured presentation follows a clear narrative:
1. Problem identification
2. Research insights
3. Design process
4. Solution overview
5. Impact and next steps

## Visual Storytelling

Use visuals to tell your story. Screenshots, mockups, and user journey maps help your audience understand the problem and solution better than text alone.

## Practice Makes Perfect

Rehearse your presentation multiple times. Know your content so well that you can present confidently, even if technical issues arise.`,
      image:
        'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '20 Jan 2024',
      author: {
        name: 'Olivia Rhye',
        avatar:
          'https://images.unsplash.com/photo-1500917293891-ef795e70e1f6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHdvbWFufGVufDB8fDB8fHww',
      },
      category: 'Design',
      slug: 'ux-review-presentations',
    },
    {
      id: 2,
      title: 'Migrating to Linear 101',
      excerpt:
        "Linear helps streamline software projects, sprints, tasks, and bug tracking. Here's how to get started.",
      content: `Linear helps streamline software projects, sprints, tasks, and bug tracking. Here's how to get started with migrating your team to this powerful project management tool.

## Why Choose Linear?

Linear stands out from other project management tools with its speed, simplicity, and developer-focused features. It's designed to reduce friction in your workflow.

## Migration Strategy

### Phase 1: Setup and Configuration
- Create your workspace
- Set up teams and projects
- Configure integrations

### Phase 2: Data Migration
- Export data from your current tool
- Import issues and projects
- Verify data integrity

### Phase 3: Team Onboarding
- Train team members
- Establish new workflows
- Monitor adoption

## Best Practices

1. Start with a pilot team
2. Migrate gradually, not all at once
3. Maintain parallel systems during transition
4. Gather feedback and iterate

The key to successful migration is taking it step by step and ensuring your team is comfortable with the new tool.`,
      image:
        'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '19 Jan 2024',
      author: {
        name: 'Phoenix Baker',
        avatar:
          'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
      },
      category: 'Software Engineering',
      slug: 'migrating-to-linear-101',
    },
    {
      id: 3,
      title: 'Building your API Stack',
      excerpt: 'The rise of RESTful APIs has been met by a rise of tools for creating, testing, and managing them.',
      content: `The rise of RESTful APIs has been met by a rise of tools for creating, testing, and managing them. Learn how to build a robust API stack for your applications.

## Modern API Architecture

Today's APIs need to be:
- **Scalable**: Handle increasing loads
- **Secure**: Protect against threats
- **Maintainable**: Easy to update and extend
- **Observable**: Monitor performance and issues

## Essential Tools

### Development
- **Framework**: Express.js, FastAPI, or Rails API
- **Documentation**: Swagger/OpenAPI
- **Testing**: Postman, Insomnia, or custom test suites

### Production
- **Gateway**: Kong, AWS API Gateway, or Zuul
- **Monitoring**: DataDog, New Relic, or custom dashboards
- **Security**: OAuth 2.0, JWT, and rate limiting

## Implementation Strategy

1. Design your API contract first
2. Set up automated testing
3. Implement proper error handling
4. Add comprehensive logging
5. Plan for versioning from day one

Building a solid API foundation early saves countless hours of refactoring later.`,
      image:
        'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '18 Jan 2024',
      author: {
        name: 'Lana Steiner',
        avatar:
          'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
      },
      category: 'Software Engineering',
      slug: 'building-your-api-stack',
    },
    {
      id: 4,
      title: 'Bill Walsh leadership lessons',
      excerpt: 'Like to know the secrets of transforming a 2-14 team into a 3x Super Bowl winning Dynasty?',
      content: `Like to know the secrets of transforming a 2-14 team into a 3x Super Bowl winning Dynasty? Bill Walsh's leadership principles apply far beyond football.

## The Standard of Performance

Walsh believed that excellence came from establishing clear standards and holding everyone accountable to them. This wasn't about winning games initially—it was about doing things the right way.

## Key Leadership Principles

### 1. Attention to Detail
Every aspect of the organization mattered, from how players dressed to how meetings were conducted.

### 2. Teaching Over Telling
Walsh was an educator first. He believed in explaining the "why" behind every decision.

### 3. Contingency Planning
Always have a plan B, C, and D. Success comes from preparation for various scenarios.

### 4. Cultural Transformation
Changing a losing culture requires patience, consistency, and unwavering commitment to your principles.

## Application in Business

These principles translate directly to business leadership:
- Set clear expectations
- Invest in your team's development
- Plan for multiple scenarios
- Focus on process over results

The transformation didn't happen overnight, but the systematic approach created sustainable excellence.`,
      image:
        'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '17 Jan 2024',
      author: {
        name: 'Alec Whitten',
        avatar:
          'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
      },
      category: 'Leadership',
      slug: 'bill-walsh-leadership-lessons',
    },
    {
      id: 5,
      title: 'PM mental models',
      excerpt: 'Mental models are simple expressions of complex processes or relationships.',
      content: `Mental models are simple expressions of complex processes or relationships. For product managers, the right mental models can dramatically improve decision-making.

## What Are Mental Models?

Mental models are frameworks that help us understand how the world works. They're shortcuts for complex thinking that help us make better decisions faster.

## Essential PM Mental Models

### 1. Jobs to Be Done (JTBD)
Customers don't buy products; they hire them to do jobs. Understanding the job helps you build better solutions.

### 2. The Kano Model
Features fall into categories:
- **Basic**: Must-haves that customers expect
- **Performance**: More is better
- **Delight**: Unexpected features that wow

### 3. ICE Framework
Prioritize features by:
- **Impact**: How much will this move the needle?
- **Confidence**: How sure are we?
- **Ease**: How hard is it to implement?

### 4. First Principles Thinking
Break down problems to their fundamental truths and build up from there.

## Applying Mental Models

The key is knowing which model to apply when. Start with the problem, then choose the framework that best helps you think through it.

Remember: models are tools, not rules. Use them to guide thinking, not replace it.`,
      image:
        'https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '16 Jan 2024',
      author: {
        name: 'Demi Wilkinson',
        avatar:
          'https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
      },
      category: 'Product',
      slug: 'pm-mental-models',
    },
    {
      id: 6,
      title: 'What is Wireframing?',
      excerpt: 'Introduction to Wireframing and its Principles. Learn from the best in the industry.',
      content: `Introduction to Wireframing and its Principles. Learn from the best in the industry and master this essential UX design skill.

## Understanding Wireframes

Wireframes are the blueprint of your digital product. They focus on structure, layout, and functionality without getting distracted by visual design.

## Types of Wireframes

### Low-Fidelity
- Basic shapes and placeholders
- Focus on layout and structure
- Quick to create and iterate

### Mid-Fidelity
- More detailed components
- Actual content and spacing
- Better for stakeholder reviews

### High-Fidelity
- Detailed interactions
- Near-final layouts
- Ready for development handoff

## Wireframing Process

1. **Understand Requirements**: Know what you're building and why
2. **Information Architecture**: Organize content logically
3. **User Flow**: Map out how users navigate
4. **Sketch**: Start with paper, then move digital
5. **Iterate**: Refine based on feedback

## Best Practices

- Keep it simple and focused
- Use consistent patterns
- Annotate for clarity
- Test early and often
- Collaborate with stakeholders

Wireframing is about solving problems, not making things pretty. Save the visual design for later—focus on function first.`,
      image:
        'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '15 Jan 2024',
      author: {
        name: 'Candice Wu',
        avatar:
          'https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
      },
      category: 'Design',
      slug: 'what-is-wireframing',
    },
    {
      id: 7,
      title: 'How collaboration makes us better designers',
      excerpt: 'Collaboration can make our teams stronger, and our individual designs better.',
      content: `Collaboration can make our teams stronger, and our individual designs better. Here's how to build a culture of effective design collaboration.

## The Power of Diverse Perspectives

Great design comes from combining different viewpoints. Developers see technical constraints, product managers understand business goals, and users provide real-world feedback.

## Building Collaborative Workflows

### Design Reviews
- Schedule regular critiques
- Focus on objectives, not opinions
- Create safe spaces for honest feedback
- Document decisions and rationale

### Cross-functional Partnerships
- Include developers early in design
- Align with product strategy
- Involve customer support insights
- Consider business constraints

### User-Centered Collaboration
- Share user research findings
- Conduct collaborative user testing
- Create shared understanding of user needs
- Use data to guide decisions

## Tools for Collaboration

- **Figma**: Real-time design collaboration
- **Miro**: Workshops and brainstorming
- **Notion**: Documentation and alignment
- **Slack**: Quick feedback and updates

## Overcoming Collaboration Challenges

Common obstacles and solutions:
- **Time zones**: Async documentation
- **Conflicting priorities**: Clear objectives
- **Different vocabularies**: Shared glossaries
- **Ego and ownership**: Focus on outcomes

The best designs emerge when teams work together toward shared goals, bringing their unique expertise to create something better than any individual could achieve alone.`,
      image:
        'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '14 Jan 2024',
      author: {
        name: 'Natali Craig',
        avatar:
          'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
      },
      category: 'Design',
      slug: 'how-collaboration-makes-us-better-designers',
    },
    {
      id: 8,
      title: 'Our top 10 Javascript frameworks to use',
      excerpt: 'JavaScript frameworks make development easy with extensive features and functionalities.',
      content: `JavaScript frameworks make development easy with extensive features and functionalities. Here's our curated list of the top 10 frameworks worth learning in 2024.

## Why Use JavaScript Frameworks?

Frameworks provide structure, reusable components, and proven patterns. They help you build applications faster and more reliably than vanilla JavaScript.

## Top 10 JavaScript Frameworks

### 1. React
- **Best for**: Interactive UIs, SPAs
- **Strengths**: Large ecosystem, flexibility
- **Use cases**: Web apps, mobile (React Native)

### 2. Vue.js
- **Best for**: Progressive adoption
- **Strengths**: Gentle learning curve, great docs
- **Use cases**: Adding interactivity to existing sites

### 3. Angular
- **Best for**: Enterprise applications
- **Strengths**: Full framework, TypeScript
- **Use cases**: Large-scale applications

### 4. Svelte
- **Best for**: Performance-critical apps
- **Strengths**: Compile-time optimizations
- **Use cases**: Fast-loading websites

### 5. Next.js
- **Best for**: React with SSR/SSG
- **Strengths**: Built-in optimizations
- **Use cases**: Production React apps

### 6. Nuxt.js
- **Best for**: Vue.js with SSR/SSG
- **Strengths**: Convention over configuration
- **Use cases**: Vue.js applications

### 7. Express.js
- **Best for**: Backend APIs
- **Strengths**: Minimal, flexible
- **Use cases**: REST APIs, microservices

### 8. Fastify
- **Best for**: High-performance APIs
- **Strengths**: Speed, modern features
- **Use cases**: Performance-critical backends

### 9. Nest.js
- **Best for**: Scalable Node.js apps
- **Strengths**: TypeScript, decorators
- **Use cases**: Enterprise backends

### 10. Gatsby
- **Best for**: Static sites
- **Strengths**: Performance, SEO
- **Use cases**: Marketing sites, blogs

## Choosing the Right Framework

Consider:
- Team expertise
- Project requirements
- Performance needs
- Long-term maintenance

There's no "best" framework—only the best framework for your specific needs and context.`,
      image:
        'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '13 Jan 2024',
      author: {
        name: 'Drew Cano',
        avatar:
          'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
      },
      category: 'Software Engineering',
      slug: 'our-top-10-javascript-frameworks-to-use',
    },
    {
      id: 9,
      title: 'Podcast: Creating a better CX Community',
      excerpt: "Starting a community doesn't need to be complicated, but how do you get started?",
      content: `Starting a community doesn't need to be complicated, but how do you get started? This podcast episode explores building thriving customer experience communities.

## What Makes a Great CX Community?

Successful communities share common characteristics:
- **Clear purpose**: Members know why they're there
- **Active moderation**: Maintains quality and culture
- **Valuable content**: Provides real benefit to members
- **Regular engagement**: Keeps the community alive

## Building Your Community Strategy

### 1. Define Your Purpose
- What problem are you solving?
- Who is your target audience?
- What value will you provide?
- How will you measure success?

### 2. Choose Your Platform
- **Discord**: Great for real-time chat
- **Slack**: Professional communities
- **Circle**: Purpose-built for communities
- **Facebook Groups**: Easy discoverability

### 3. Create Engaging Content
- Educational resources
- Industry insights
- Member spotlights
- Q&A sessions

### 4. Foster Connections
- Facilitate introductions
- Create collaboration opportunities
- Host virtual and in-person events
- Recognize active members

## Common Pitfalls to Avoid

- Starting too broad—niche is better
- Not engaging consistently
- Over-promoting your products
- Ignoring negative behavior
- Expecting immediate growth

## Scaling Your Community

As your community grows:
- Establish clear guidelines
- Train community moderators
- Create member-led initiatives
- Develop leadership pipeline
- Maintain the original culture

Remember: communities are built on relationships, not technology. Focus on bringing value to your members, and growth will follow naturally.`,
      image:
        'https://images.unsplash.com/photo-1478737270239-2f02b77fc618?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80',
      date: '12 Jan 2024',
      author: {
        name: 'Orlando Diggs',
        avatar:
          'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80',
      },
      category: 'Podcasts',
      slug: 'podcast-creating-a-better-cx-community',
    },
  ];

  const getAllBlogs = () => blogs;

  const getBlogBySlug = (slug: string) => {
    return blogs.find(blog => blog.slug === slug);
  };

  const getBlogsByCategory = (category: string) => {
    return blogs.filter(blog => blog.category === category);
  };

  const getRecentBlogs = (limit: number = 3) => {
    return blogs.slice(0, limit);
  };

  return {
    getAllBlogs,
    getBlogBySlug,
    getBlogsByCategory,
    getRecentBlogs,
  };
};
