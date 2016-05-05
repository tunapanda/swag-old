# swag
*swag* is the codename for skills that help people earn a higher income and achieve greater personal freedom through self-expression. This is the software that helps people achieve more *swag*.

Related
-------

* [Swag Technical Overview](TECHNICAL.md)s

# FAQ

## Why be so concerned with offline deployment? Can't you just put the software and learning materials online?

1. **Money is scarce** for most people and internet bandwidth is expensive. Even people who can afford their own smartphone are often happy to browse Twitter but are very careful to avoid video sites like YouTube. Videos are great learning tools - but a "free" 100MB TED Talk is not free when you earn $2/day and would have to pay $0.50 to $1.00 for that 100MB of bandwidth on your mobile phone. It would actually be cheaper to buy a DVD with the data already on it than to download it yourself! Deploying/distributing offline means that people can learn more and spend less.
2. Internet is unreliable, even in relatively advanced cities like Nairobi - waiting for videos to load is frustrating. **Frustration is not conducive to learning.** Hosting content locally decreases load times and removes frustration.

## Why teach technology, design, and business skills when so many people have a hard time affording food?

People earn an income by creating value and solving problems for others. Technologies are effectively tools that enable humans to do more with less. Besides the fact that the internet and other ICT (Information Communication Technology) advances enable people to perform work in Africa for clients around the world, knowledge of such skills can help people a) learn more individually or in groups, b) solve local problems, and c) apply those solutions on a global scale.

On the topic of food: a great deal food in Africa rots or gets eaten by pests because there is a lack of pricing information and efficient distribution channels. The proper deployment of software, other technology, design thinking, and proper business practices can solve problems like that - and those closest to the problems are the ones who will discover the best solutions. But only with the ability to learn.

## Don't we need more teachers? Are you trying to replace teachers with technology?

Absolutely. We have a saying at Tunapanda Institute that "everyone here is a teacher." We don't just build software and create learning content - we all stand up in front of real people and run real classes. We select and train new [team members](www.tunapanda.org/apprenticeships) based on their aptitute for teaching and ability to facilitate peer-to-peer learning.

All the technology we build is aimed at helping teachers, formal or informal, to do their jobs better - and to enable anyone to become a teacher of herself, her family, her community, and her planet.

## The Origins of *swag*

*Teenager in Kibera, Nairobi, walks into a Tunapanda computer lab after school wearing his school uniform. The fat part of his tie is short, the skinny part goes down to his knees.*

> Me: Nice tie, Marc.

> Marc: Thanks, teacher. It's my *swag*.

## *swag* in Layman's Terms

A key mechanism for spreading learning to low-income parts of the world, including here in East Africa, is video learning content which can simultaneously decrease cost while increasing quality of education. Software and videos will never replace good teachers, but they are certainly the best option when no other affordable option exists.

However, both guidance and motivation are currently huge problems for video learning. This *swag* software is designed to help solve those problems by:

- Creating clear, automated pathways through material so students can learn at their own pace with minimal guidance.
- Providing a lightly-gamified environment to help with motivation.
- Allowing localized customization of the scoring system.
- Helping minimally-trained teaching facilitators guide others to mastery and see what's working and what isn't.

## *swag* in Gamers' Terms

Every student interacting with our learning platform should be treated as much like a game player as possible. In other words: it's our job to keep them engaged and provide manageable challenges while minimizing boredom and confusion - we don't order them to engage or hit them with sticks when they fail to comply.

A player starts off in the game environment with very little knowledge of the world of technology, design and storytelling. Many have never handled a computer before, nor seen anyone touch-type properly. There is very likely no internet access and unreliable electricity. Thus the environment needs to be self-contained... and time is of the essence.

By moving around the open source software and freely-licensed content on Tunapanda Edubuntu, a player collects *swag* points. Some of this *swag* is automatically recorded - for example when a student achieves a certain level of touch-typing. Other *swag* must be verified by other players who have achieved higher levels of *swag*. For example, editing a short community journalism video following certain rules of film, or building a website using Drupal or Wordpress following certain specification.

## *swag* from a Technical Standpoint

*swag* can be viewed as a proxy word for *skill*. There are various types of *swag* but we can ignore that for now.

To achieve a certain level of *swag* in a given skill area, players might engage in any combination of the following:
- Watch **video content** (can often be substituted by a **human lesson**).
- Complete a **quiz, group activity or project**. Note: quizzes are more often used to help players check their understanding rather than as achievement indicators.
- Achieve a certain **level** within a *swag* area based on experience.

Note: Achieving (or even attempting) certain *swag* elements might require **prerequisites**. Those prerequisites might be *swag* or level.

Swag System
=========================

Introduction
------------
####General overview

Swag is a system for guiding learners through different learning paths. It does not dictate a specific path to the learner, 
but suggests that some knowledge are prerequisites to other knowledge. 

It engages the user by relying on metaphors from 
computer games, and tries to trigger the users curiosity for exploration and desire for completeness.

The system is also designed to be usable as a teaching aid in the classroom which in turn becomes a tool for propagating education through peer-to-peer learning.  

The system allows for knowledge creation from someone who has knowledge in a given field and learners a like through suggestions 

####Concepts


<img align="right" width="250" src="https://raw.github.com/tunapanda/swag/master/doc/swag_system_diagram.png" />

There are some concepts that work together to make up the complete system. These are described in more detail throughout this document
* __Swagifact__  
  An item/module of knowledge about a given concept.
* __Swagpath__ 
Collection of related Swagifacts
* __Swagmap__  
  A map of interconnected nodes that guides the user through the learning experience.
* __Learning Record Store (LRS)__  
  The database that keeps track of of users progress in a given thing.
* __Reporting Applications__  
  An application that sits in the background and gather information about what the user does and reports this to the
  Learning Record Store.

Setup
------------
Swag system is built on wordpress therefore ensure you <a href="https://codex.wordpress.org/Installing_WordPress">install wordpress</a>.  

The system has a custom made theme that ties everything together. Instructions on how to install it can be found <a href="https://github.com/tunapanda/TI-wp-content-theme">here</a>.

To set everything up, there are a number of plugins you need.
* 


Use case
------------

Features and capabilities
------------
####Swag
A piece of swag is a badge that a user can earn through completing different activities in
the system. The swag that a user have earned is stored in the LRS.

####Swagpaths
<img align="right" width="300" src="https://raw.github.com/tunapanda/swag/master/doc/edit_swagpath.png" />

A swagpath is a course in the system. It is named this way because it takes the user from one
swag to another, i.e. the path from one swag to another. 
Each swagpath can have a number of required
swag, i.e. the prerequisites for the swagpath. It can also have a number of provided swag,
which are the badges that the user will earn upon completing the swagpath. The prerequisites
are never "hard", i.e. the system will never stop a user from exploring or attempting a
swagpath, rather the system will let the user access any swagpath he or she wants to
acces. If the user does not have the prerequisites for a particular swagpath, the system will
hint the user that it might make sense to collect the prerequisite swag first.

A swagpath contains a number of items, and each such item is called a swagifact. A swagifact
is usually a piece of [H5P](https://h5p.org/) content, but there are also other types of
swagifacts supported. See swagifact below.

Each swagpath is implemented in the system as a wordpress
page, using a number of special Wordpress [shortcodes](https://codex.wordpress.org/Shortcode).

The swag that is required or provided by the swagpath is implemented usig Wordpress
[custom fields](https://codex.wordpress.org/Custom_Fields).

The screenshot shows the editing of a swagpath, including the shortcodes and custom fields
discussed above.

####Swagmap
<img align="right" width="300" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap.png" />
A swagmap is a map that shows the relationships of swagpaths and their required and provided
swag. It is intended to be a guide for the user, where he or she can get an overview of
what skills build on top of other skills.

Also, the swagmap will show which swag that is completed by the user already.

####Deliverables
####Lesson plans
####Feedback
####Managing users
####Deliverables
####Synchronisation
Synchronisation utilizes the concepts of a version control system, where a user can pull, push, merge/sync changes. Synchronization in the swag system is handled by the <a href="https://github.com/tunapanda/wp-remote-sync">wp-remote-sync</a> plugin.

####Learning Record Store
<img align="right" width="300" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap_lrs_screenshot.png" />

The learning record store keeps track of the progress for each user. In order to talk to the
LRS we use the xAPI protocol. The LRS is a standardized component that speaks xAPI, i.e. not
something we have built specifically for the Swag system, and we can replace the currently 
used LRS with another one as long as that one speak xAPI. We currently use 
[Learning Locker](https://learninglocker.net/), 
which is an open source implementation of an xAPI compliant LRS.

xAPI is a RESTful API, which means that it uses HTTP as its underlying protocol. This is the
same protocol that a web browser uses to talk to a webserver. This means that it is
relatively simple to create software that speaks it, since it is possible 
to reuse software libraries already created for other HTTP communication. There are
implementations of xAPI in most popular programming languages.

####H5P
####reporting application
######Ktouchxapi

Deployment
------------





Swagmaps
--------

<img align="right" width="250" src="https://raw.github.com/tunapanda/swag/master/doc/swagmapviewer_screenshot.png" />

A Swagmap is a map of interconnected nodes. Each node represents a swagifact, and a node can be shown as complete or not 
yet completed. Depending on how the swagmap is defined, certain swagifacts can be set as prerequisites for other swagifacts,
so the depending swagifacts are not shown unless the prerequisites are completed.

Clicking on a swagifact in the swagmap will open up information showing what the user needs to do for that swagifact to be
completed. If the swagifact can be completed online, the user will be taken directly to where the swagifact can be completed.

The swagmap software is a web based software and is currently in an early stage of development. It currently looks like in
the top right figure.

Here, the circles represents the swagifacts, and the one marked in red is represented as completed. This is a technical
prototype to test the functionality, the goal is that this should be a compelling, game like interface with game like
interaction metaphors and animations. The following images can be seen as a mood board to serve as inspiration for what
we want the application to look like eventually.

<img align="center" height="185" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap_moodboard_1.png" />
<img align="center" height="185" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap_moodboard_2.png" />
<img align="center" height="185" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap_moodboard_3.jpg" />

The swagmap application is developed on github here: https://github.com/tunapanda/swagmapviewer

Swagifacts
----------

A swagifact represents an atom of learning. A swagifact can represent something that the user can experience online, 
such as watching a video or answering some multiple choice questions, or it can represent something the user needs to do 
in an outside system, in which case it will be reported by reporting application.

The swag system does very little in terms of defining how a swagifact should actually be implemented. All it knows is that 
a swagifact resides on a url, and upon clicking on the swagifact the user will be taken to that url.

It is assumed that when the user completes the swagifact, this will be reported to the LRS using xAPI, but how this is 
actually implemented is up to the particular swagifact or reporting application.

We have started creating swagifacts in H5P, an open source tool for creating e-learning artifacts in HTML5.

Reporting Applications
----------------------

<img align="right" width="250" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap_ktouchxapi_screenshot.png" border="10"/>

When we create swagifacts, we can make it easy for ourselves and choose tools that support xAPI, and these will easily 
integrate with the rest of the architecture. H5P is an example of such a tool. However, we would like to be able to gather 
information from as many sources as possible, also from sources that do not support xAPI. In these cases, we use a reporting 
application to bridge the gap from those systems to our LRS. 

One example of such a reporter application is [ktouchxapi](https://github.com/tunapanda/ktouchxapi), which takes statistics
from the touch typing tutor application KTouch and inserts it into our xAPI compliant LRS.

In order to have a modular approach to the architecture of the system, the reporting application doesn’t have dependencies 
on any other components of the system, other than the fact that it speaks xAPI. Reporting applications are command line tools 
that can be run periodically in the background, and they look and behave in similar ways to standard UNIX command line tools.

Ktouchxapi is the first reporting application we have developed, we envision more of these in the future. The next envisioned 
reporting application is for arbtt, which is a system that tracks which applications a user runs and how often and how long 
these applications are used. This way, we can give users swag credits upon using certain applications.
