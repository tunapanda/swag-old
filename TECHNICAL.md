Swag - Technical Overview
=========================

Introduction
------------

Swag is a system for guiding learners through different learning paths. It does not dictate a specific path to the learner, 
but suggests that some knowledge are prerequisites to other knowledge. It engages the user by relying on metaphors from 
computer games, and tries to trigger the users curiosity for exploration and desire for completeness.

Concepts
--------

<img align="right" width="250" src="https://raw.github.com/tunapanda/swag/master/doc/swag_system_diagram.png" />

There are some concepts that work together to make up the complete system. These are described in more detail throughout this document.

* __Swagmap__  
  A map of interconnected nodes that guides the user through the learning experience.
 
* __Swagifact__  
  An atom of learning. Each node in the swagmap is an instance of swagifact. The same swagifact can be used in several
  swagmaps.

* __Learning Record Store__  
  The database that keeps track of which swagifacts each user has completed.

* __Reporting Applications__  
  An application that sits in the background and gather information about what the user does and reports this to the
  Learning Record Store.

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

<img height="200" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap_moodboard_1.png" />
<img height="200" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap_moodboard_2.png" />
<img height="200" src="https://raw.github.com/tunapanda/swag/master/doc/swagmap_moodboard_3.jpg" />

The swagmap application is developed on github here:

https://github.com/tunapanda/swagmapviewer

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

Learning Record Store
---------------------

The learning record store keeps track of the progress for each user. In order to talk to the LRS we use the xAPI protocol. 
The LRS is a standardized component that speaks xAPI, i.e. not something we have built specifically for the Swag system, and 
we can replace the currently used LRS with another one as long as that one speak xAPI. We currently use Learning Locker, 
which is an open source implementation of an xAPI compliant LRS.

xAPI is a RESTful API, which means that it uses HTTP as its underlying protocol. This is the same protocol that a web browser 
uses to talk to a webserver. This means that it is relatively simple to create software that speaks it, since it is possible 
to reuse software libraries already created for other HTTP communication. There are implementations of xAPI in most popular 
programming languages.

Reporting Applications
----------------------

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
