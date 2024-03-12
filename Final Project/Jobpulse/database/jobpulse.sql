-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table jobpulse.about_settings
CREATE TABLE IF NOT EXISTS `about_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_vision` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.about_settings: ~0 rows (approximately)
INSERT INTO `about_settings` (`id`, `banner`, `company_history`, `our_vision`, `created_at`, `updated_at`) VALUES
	(1, 'uploads/1710043130.jpg', '<ol>\r\n	<li>\r\n	<p><strong>Academic Positions</strong>: Historians often pursue careers in academia, teaching at colleges and universities. The availability of these positions can fluctuate based on funding for higher education institutions and the demand for history courses. Tenure-track positions may be competitive, but there can also be opportunities for adjunct or visiting professor roles.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Research Positions</strong>: Historians may also work in research roles, either within academic institutions, think tanks, or private research organizations. These positions may involve conducting original research, writing publications, and contributing to historical understanding in various fields.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Archives and Museums</strong>: Historians can find employment in archives, libraries, and museums, where they may work as archivists, curators, or museum educators. These positions involve managing collections, curating exhibits, and providing historical interpretation to the public.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Government and Nonprofit Organizations</strong>: Historians may work for government agencies, non-profit organizations, or historical societies. These roles can involve policy research, preservation efforts, and public outreach initiatives related to historical topics.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Heritage and Tourism</strong>: Some historians work in heritage and tourism industries, developing historical sites, creating guided tours, and promoting historical destinations to visitors.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Publishing and Media</strong>: Historians may also pursue careers in publishing, writing historical books, articles, or contributing to historical documentaries, podcasts, and other media productions.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Digital Humanities and Technology</strong>: With the increasing digitization of historical records and the growth of digital humanities, there are opportunities for historians with skills in data analysis, digital archiving, and utilizing technology for historical research and presentation.</p>\r\n	</li>\r\n</ol>', '<ol>\r\n	<li>\r\n	<p><strong>Growing Interest in Digital History</strong>: With advancements in technology, there&#39;s a growing demand for historians who possess digital skills. This includes proficiency in digital archiving, data analysis, GIS (Geographic Information Systems), and digital storytelling. Future job opportunities may increasingly involve digital humanities projects, online education, and virtual museum experiences.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Interdisciplinary Opportunities</strong>: Historians who can integrate their knowledge with other disciplines such as sociology, political science, economics, or environmental studies may find expanded job prospects. Interdisciplinary approaches are becoming more common in research projects, policy analysis, and public outreach initiatives.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Diversification of Career Paths</strong>: Historians are exploring diverse career paths beyond academia and traditional historical institutions. This includes roles in public policy, advocacy, consulting, and corporate sectors where historical understanding is valued for decision-making, strategic planning, and understanding societal trends.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Global Perspectives</strong>: With globalization and interconnectedness, there&#39;s a growing demand for historians who specialize in global history, transnational studies, and comparative analysis. Job opportunities may arise in international organizations, multinational corporations, and NGOs where understanding historical contexts across cultures and regions is crucial.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Community Engagement and Public History</strong>: There&#39;s an increasing emphasis on community engagement and public history initiatives. Historians who can work effectively with local communities, contribute to oral history projects, and engage in heritage preservation efforts may find rewarding opportunities in grassroots organizations, local governments, and cultural institutions.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Environmental History and Sustainability</strong>: Given the growing concerns about climate change and environmental sustainability, historians specializing in environmental history are in demand. Job opportunities may arise in research institutions, advocacy groups, and government agencies focused on environmental policy, conservation, and sustainable development.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Continued Need for Traditional Roles</strong>: Despite the emergence of new trends, there will still be demand for historians in traditional roles such as teaching, research, archival management, and museum curation. However, individuals may need to adapt to evolving technologies and interdisciplinary approaches to remain competitive in these fields.</p>\r\n	</li>\r\n</ol>', '2024-03-09 21:58:50', '2024-03-09 21:58:50');

-- Dumping structure for table jobpulse.apply_jobs
CREATE TABLE IF NOT EXISTS `apply_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `job_id` bigint unsigned NOT NULL,
  `accept` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apply_jobs_user_id_foreign` (`user_id`),
  KEY `apply_jobs_job_id_foreign` (`job_id`),
  CONSTRAINT `apply_jobs_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `apply_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.apply_jobs: ~1 rows (approximately)
INSERT INTO `apply_jobs` (`id`, `user_id`, `job_id`, `accept`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 0, '2024-03-12 05:54:04', '2024-03-12 05:54:04');

-- Dumping structure for table jobpulse.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_user_id_foreign` (`user_id`),
  CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.blogs: ~0 rows (approximately)
INSERT INTO `blogs` (`id`, `text`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, '<h1>Blogging for Software Developers</h1>\r\n\r\n<p><a href="https://simpleprogrammer.com/author/jsonmez"><img alt="Text Only 02" src="https://secure.gravatar.com/avatar/695e2a956b2dcb5ac45a7095b6ee338a?s=256&amp;d=retro&amp;r=pg" style="height:256px; width:256px" /></a></p>\r\n\r\n<p><em>Written By</em>&nbsp;<a href="https://simpleprogrammer.com/author/jsonmez/">JOHN SONMEZ</a></p>\r\n\r\n<p>I honestly think one of the best possible things you can do for your software development career is to start a blog&mdash;and regularly update it.</p>\r\n\r\n<p>I have to admit I&rsquo;m a little bit biased.</p>\r\n\r\n<p>After all,&nbsp;<strong>you probably wouldn&rsquo;t be reading this book and I probably wouldn&rsquo;t be writing it, if one day in late 2009, I hadn&rsquo;t decided to create the blog named &ldquo;<a href="https://simpleprogrammer.com/cg53-homepage">Simple Programmer: Making the Complex Simple</a>.&rdquo;</strong></p>\r\n\r\n<p>I had no idea what I was doing.</p>\r\n\r\n<p>I had no ambitions.</p>\r\n\r\n<p><strong>I just wanted to share my thoughts and my experiences</strong>, mostly with my work team, since I knew they would likely read my blog.</p>\r\n\r\n<p>But I kept writing, week after week.</p>\r\n\r\n<p>And then things started to happen.</p>\r\n\r\n<p>Amazingly,&nbsp;<strong>people actually started to read what I was writing&mdash;</strong>not many people, but there were enough that I started to notice, and then people started to notice me.</p>\r\n\r\n<p><strong>I started getting job offers and opportunities.</strong></p>\r\n\r\n<p>Eventually I took one opportunity to&nbsp;<a href="https://simpleprogrammer.com/cg53-pluralsight">create some online courses</a>&nbsp;for a small&mdash;at the time&mdash;company called Pluralsight.</p>\r\n\r\n<p><strong>In three years time, I ended up creating 55 courses for Pluralsight and making literally a few million dollars in royalties.</strong></p>\r\n\r\n<p>I got invited to speak on podcasts and at conferences and events.</p>\r\n\r\n<p>The readership of Simple Programmer grew and grew, and eventually that little bit of affiliate income I was generating from recommending Amazon products in my blog posts also grew.</p>\r\n\r\n<p>I launched my first product, &ldquo;<a href="https://simpleprogrammer.com/cg53-marketyourself">How to Market Yourself as a Software Developer</a>,&rdquo; to my growing audience at Simple Programmer and it was a huge success.</p>\r\n\r\n<p>Eventually,&nbsp;<strong>I quit my full-time job</strong>&nbsp;and started to work on Simple Programmer full time.</p>\r\n\r\n<p><strong>My little blog from 2009 was providing me a full-time income.</strong></p>\r\n\r\n<p>Today, that blog is still growing.</p>\r\n\r\n<p>Today, Simple Programmer&nbsp;<strong>employs three people full time</strong>, and many part-time contractors.</p>\r\n\r\n<p>Simple Programmer has become a real business, has allowed me to&nbsp;<strong><a href="https://simpleprogrammer.com/cg53-travel">travel the world</a>, meet people I&rsquo;d never thought I&rsquo;d meet</strong>, and&nbsp;<strong>make a real positive impact on people&rsquo;s lives.</strong></p>\r\n\r\n<p>It all started from a blog and a simple message to make the complex simple.</p>\r\n\r\n<p>I&rsquo;m not special: if I can do it, so can you.</p>\r\n\r\n<p>The journey may not be easy, but in this chapter, I&rsquo;ll share with you what I know.</p>\r\n\r\n<h2>Why A Blog Is Still Your Best Choice</h2>\r\n\r\n<p><img alt="" src="https://simpleprogrammer.com/wp-content/uploads/2017/07/Blogging-1024x576.png" style="height:399px; width:709px" /></p>\r\n\r\n<p>Today, I get&nbsp;<a href="https://simpleprogrammer.com/cg53-youtube">more traffic to my YouTube channel</a>&nbsp;each day than I do to my Simple Programmer blog.</p>\r\n\r\n<p>But&nbsp;<strong>I still think blogging is the best choice for most software developer</strong>s (although, you should consider YouTube as well).</p>\r\n\r\n<p>The reason why is simple:&nbsp;<strong>it&rsquo;s low barrier to entry and it&#39;s extremely effective.</strong></p>\r\n\r\n<p>For a long time people have been ringing the death knell of blogging and saying that it&#39;s dead because too many people are blogging and there are too many blogs out there, but it&rsquo;s just not true.</p>\r\n\r\n<p>Yes, there are quite a few blogs out there now, but most of them don&rsquo;t have many posts and are not regularly maintained.</p>\r\n\r\n<p><strong>If you blog regularly and consistently, it&rsquo;s almost guaranteed that someone searching for your name on the internet will&nbsp;<a href="http://rodrigochichierchio.com/content-marketing-4-million-posts/">find your blog</a>.</strong></p>\r\n\r\n<p>This is going to enhance your reputation for any recruiter, employer, or possible customer, just by virtue of you having a blog that is regularly updated.</p>\r\n\r\n<p>Countless students of&nbsp;<a href="https://simpleprogrammer.com/cg53-blog">my blogging course</a>&nbsp;have emailed me to tell me about how having a blog got them a better job, either because a potential employer saw their blog and decided to hire them, or they received an invitation to apply for a job from someone who came across their blog.</p>\r\n\r\n<p>And the best part is, it&rsquo;s so easy.</p>\r\n\r\n<p><strong>Anyone can&nbsp;<a href="https://simpleprogrammer.com/cg53-5minutes">create a blog and have one up and running in five minutes or less.</a></strong></p>\r\n\r\n<p>Yes, you still have to do the work for writing blog posts on a regular basis, but anyone can get good at doing that with just a little bit of practice over time.</p>\r\n\r\n<p><strong>Think of a blog as an advertisement for you that works all day and night without you having to do anything</strong>&nbsp;other than feed it every once in awhile.</p>\r\n\r\n<p>Aside from the external opportunities blogging offers you, it offers some great personal development opportunities as well.</p>\r\n\r\n<p>I don&rsquo;t think there is any better way to improve your communication skills than writing.</p>\r\n\r\n<p><strong>Writing teaches you to organize your thoughts clearly in a way that other people can understand.</strong></p>\r\n\r\n<p>The more you write, the better of a communicator you&rsquo;ll become in general.</p>\r\n\r\n<p>Blogging also helps you keep track of your own career and progress, as well as provides some historical documentation and reference material which you can look back on to see how you solved a particular problem in the past.</p>\r\n\r\n<p>I&rsquo;m always searching my own blog for answers to current problems that I know I&rsquo;ve solved or talked about in the past.</p>\r\n\r\n<p>Every software developer should have their own blog: it&rsquo;s like a lightsaber for a Jedi.</p>\r\n\r\n<h2>How To Create A Blog<img alt="" src="https://simpleprogrammer.com/wp-content/uploads/2017/07/Create-a-Blog-1024x1024.png" style="height:356px; width:356px" /></h2>\r\n\r\n<p>Alright, so you are convinced you need a blog, great!</p>\r\n\r\n<p>But how do you actually create one?</p>\r\n\r\n<p><em>(I&rsquo;m going to cover some of the basics here, but I&rsquo;d highly recommend&nbsp;<a href="https://simpleprogrammer.com/cg53-blog">you sign up for my free blogging course</a>&nbsp;for some step-by-step details and a complete walkthrough of creating your blog.)</em></p>\r\n\r\n<p><strong>My first advice is not to create one</strong>&hellip; well, I mean not to create one yourself.</p>\r\n\r\n<p>Many software developers are tempted to create their own blog, from scratch, and not use an off-the-shelf solution.</p>\r\n\r\n<p>This is a bad&mdash;nay, horrible&mdash;idea.</p>\r\n\r\n<p>Here&rsquo;s why.</p>\r\n\r\n<p>The point of blogging is not to exercise your ability to write blogging software, which is more difficult than you think.</p>\r\n\r\n<p>The point of blogging is to build your reputation, get your name out there, and record your ideas, not to increase your development skills.</p>\r\n\r\n<p>It&rsquo;s not that there is anything necessarily wrong with creating your own blog, but doing so is going to&nbsp;<strong>waste a large amount of time that you could be using to write and actually publish your blog posts.</strong>&nbsp;If you never finish the project of creating your own blog&mdash;which is highly likely&mdash;you&rsquo;ll never have a blog.</p>\r\n\r\n<p>Plus, the commercial blogging software out there is extremely good, widely used and supported, and has a huge number of plugins and integrations which you could never write on your own.</p>\r\n\r\n<p>In fact,&nbsp;<strong>I&rsquo;d highly recommend you use WordPress as your blogging platform</strong>, since it is the most dominant software in the blogging space and as a result, has the largest number of plugins and extensibility points.</p>\r\n\r\n<p>I use WordPress for all of my websites, because it is that flexible and easy to use.</p>\r\n\r\n<p>Creating your blog with WordPress is&nbsp;<strong>extremely easy.</strong></p>\r\n\r\n<p>The first thing you need is a host.</p>\r\n\r\n<p>I recommend either using&nbsp;<a href="https://simpleprogrammer.com/cg53-bluehost">Bluehost</a>&nbsp;or&nbsp;<a href="https://simpleprogrammer.com/cg53-wpengine">WP Engine</a>&nbsp;if you are just starting out.</p>\r\n\r\n<p>Currently, Simple Programmer runs on a&nbsp;<a href="https://simpleprogrammer.com/cg53-ocean">Digital Ocean</a>&nbsp;droplet that is specially configured, but I have a Linux admin who handles all of the maintenance for that system.</p>\r\n\r\n<p>I wouldn&rsquo;t recommend going the route I am using until you really need the performance, which you won&rsquo;t until you have huge traffic spikes.</p>\r\n\r\n<p><a href="https://simpleprogrammer.com/cg53-bluehost">Bluehost</a>&nbsp;is a good choice if you are looking to save money initially, and you don&rsquo;t anticipate a huge amount of traffic.</p>\r\n\r\n<p><a href="https://simpleprogrammer.com/cg53-wpengine">WP Engine</a>&nbsp;is a bit more robust and scalable, so it can handle heavier loads, but is a bit more expensive.</p>\r\n\r\n<p>Once you&rsquo;ve picked your host, you need to get your blogging software installed.</p>\r\n\r\n<p>For&nbsp;<a href="https://simpleprogrammer.com/cg53-bluehost">Bluehost</a>, it&rsquo;s an extremely simple process. Just a few clicks.</p>\r\n\r\n<p>For&nbsp;<a href="https://simpleprogrammer.com/cg53-wpengine">WP Engine</a>, it&rsquo;s even easier, since you already get WordPress installed when you set up your account.</p>\r\n\r\n<p>If you use a solution like&nbsp;<a href="https://simpleprogrammer.com/cg53-ocean">Digital Ocean</a>, you may have to manually install WordPress yourself or use a snapshot image that they provide with it preinstalled. (Although, remember you&rsquo;ll have to maintain an entirely virtual server.)</p>\r\n\r\n<p><strong>I&rsquo;d highly recommend registering your own custom domain to go with your new blog.</strong></p>\r\n\r\n<p>Don&rsquo;t just use the default one a blog hosting provider will give you since you will want to build what is known as pagerank or domain authority for your domain.</p>\r\n\r\n<p>Your pagerank and domain authority will influence how much traffic you get from search engines later on, so it is very much worth the small investment of registering your own domain.</p>\r\n\r\n<p><strong>You should be able to get your actual blog set up in just a few hours, so don&rsquo;t delay the process: take action right away.</strong></p>\r\n\r\n<p>In fact, if you&rsquo;ve been procrastinating on starting your blog, finish this chapter, then&nbsp;<strong>put the book down</strong>&nbsp;and do it today. You&rsquo;ll be glad you did and it&rsquo;s not that difficult to do.</p>\r\n\r\n<h2>Picking A Theme</h2>\r\n\r\n<p>One of the first things you&rsquo;ll want to do when you start your blog&mdash;probably even before you pick your domain name&mdash;is to&nbsp;<strong>pick the theme of your blog.</strong></p>\r\n\r\n<p>When I say theme here,&nbsp;<strong>I don&rsquo;t mean WordPress theme</strong>. (Although if you&rsquo;d like a recommendation on where to get a WordPress theme, I recommend and use&nbsp;<a href="https://simpleprogrammer.com/cg53-thrive">Thrive Themes</a>.)</p>\r\n\r\n<p>But, let&rsquo;s get back on topic. What I mean is,&nbsp;<strong>what is your blog about?</strong></p>\r\n\r\n<p>How are you going to describe your blog and what are you going to focus on?</p>\r\n\r\n<p>This is essentially the same as&nbsp;<a href="https://simpleprogrammer.com/cg53-niching">your specialization or niche.</a></p>\r\n\r\n<p><strong>You want to make the theme of your blog very focused and small initially</strong>. You can always expand it later.</p>\r\n\r\n<p>So for example, you might create a blog all about using the ListView control in Android.</p>\r\n\r\n<p>This might seem like an extremely small and narrow topic, but I guarantee you that you can come up with hundreds of posts about using the ListView control and how to customize it and other closely related topics.</p>\r\n\r\n<p>By picking an extremely narrow focus like that, you&rsquo;ll be able to dominate that space much more easily and be able to grow at a faster rate.</p>\r\n\r\n<p>It would be much easier to become known as the expert on the Android ListView control than it would be to be known as the expert on the C# or Java or Agile development.</p>\r\n\r\n<p>So&nbsp;<strong>try and pick a very narrow focus for the theme for your blog</strong>, but not so small that you can&rsquo;t come up with at least 50 ideas for posts around that theme.</p>\r\n\r\n<p>You can also make your theme a bit unique by taking a different angle on a broader subject.</p>\r\n\r\n<p>Making a blog about C# would be a bit too broad and not narrowly focused enough, but if you made a blog about C# where the theme is funny and informative C# stories, where you explained some C# concept using a funny story and perhaps a comic strip, that would be an excellent theme for a blog.</p>\r\n\r\n<p><strong>You can also combine multiple things together.</strong></p>\r\n\r\n<p>I have a podcast (now a bit defunct) called &ldquo;<a href="https://simpleprogrammer.com/cg53-getup">Get Up and Code</a>.&rdquo;</p>\r\n\r\n<p>The podcast was about the intersection between programming and fitness.</p>\r\n\r\n<p>Either of those topics is too broad for a theme, but together, they create a much smaller niche that is tightly focused.</p>\r\n\r\n<p>The key thing to think about is&nbsp;<strong>what kind of theme can you pick for your blog where you can be known for being number one in the world</strong>&nbsp;for a particular topic or niche.</p>\r\n\r\n<p>Brainstorm a list of possible themes and pick the most promising ones where you feel like you can dominate that particular niche and be number one.</p>\r\n\r\n<p>If I asked you what is the number one blog in the world for teaching software developers soft skills, what would you say?</p>\r\n\r\n<p>Hopefully, you&rsquo;d say Simple Programmer.</p>\r\n\r\n<h2>How To Blog</h2>\r\n\r\n<p><img alt="" src="https://simpleprogrammer.com/wp-content/uploads/2017/07/Blogdsging-1024x576.png" style="height:411px; width:730px" /></p>\r\n\r\n<p>Blogging is both easier and more difficult than it looks.</p>\r\n\r\n<p>It&rsquo;s easier, because all you have to do is write and then publish what you write.</p>\r\n\r\n<p>It&rsquo;s more difficult because&nbsp;<strong>writing is difficult.</strong></p>\r\n\r\n<p>Even if you are an experienced writer, writing can be a challenge.</p>\r\n\r\n<p>I&rsquo;m standing here at my desk, typing this chapter, and my head is constantly filled with doubts about what I am writing.</p>\r\n\r\n<p>Is this sentence good?</p>\r\n\r\n<p>Am I going the right direction with this chapter?</p>\r\n\r\n<p>Why do my wrists hurt?</p>\r\n\r\n<p>Ultimately though,&nbsp;<strong>you just have to do it.</strong></p>\r\n\r\n<p>Everything you write won&rsquo;t be good.</p>\r\n\r\n<p>When you first start writing,&nbsp;<a href="https://simpleprogrammer.com/cg53-crappy">you&rsquo;ll probably suck&mdash;</a>that&rsquo;s ok.</p>\r\n\r\n<p>Eventually you&rsquo;ll get better.</p>\r\n\r\n<p>You have to&nbsp;<a href="https://simpleprogrammer.com/cg53-trust">trust the process.</a></p>\r\n\r\n<p>I do have a few tips that will help you to write your blog posts and make them as effective as possible, though.</p>\r\n\r\n<p>First of all,&nbsp;<strong>make sure you know what you are going to write before you write it.</strong></p>\r\n\r\n<p>I highly recommend having a list of topics you are going to write about. When you sit down to write a blog post, pick one of those topics and start writing.</p>\r\n\r\n<p>For this book, I outlined the entire book and decided on all the chapters before I started writing anything.</p>\r\n\r\n<p>Now when I get up in the morning and start writing, I know exactly what I&rsquo;m supposed to write about.</p>\r\n\r\n<p>I don&rsquo;t spend hours wasting time trying to come up with a topic.</p>\r\n\r\n<p>I do the same thing for my blog posts&mdash;well, most of the time.</p>\r\n\r\n<p><strong>One of the best ways to beat procrastination is to know what you are supposed to do.</strong></p>\r\n\r\n<p>When you know what you are supposed to do, you are much less likely to procrastinate.</p>\r\n\r\n<p>Next, I&rsquo;d recommend that&nbsp;<strong>if you need to do research, you do it all up front.</strong></p>\r\n\r\n<p>It&rsquo;s much easier to write on a topic in which you are well-versed.</p>\r\n\r\n<p>So go and explore the topic and do the research before you sit down to write.</p>\r\n\r\n<p>If your piece is an opinion piece, you might not need any research, but you might want to sit down and gather your thoughts on the subject or even discuss it with someone.</p>\r\n\r\n<p>Some of my best blog posts come from conversations&mdash;or even arguments&mdash;I&rsquo;ve had with someone about a topic the night before.</p>\r\n\r\n<p>You&rsquo;ll also want to&nbsp;<strong>create some kind of an outline before you start writing.</strong></p>\r\n\r\n<p>I find it useful to come up with a rough outline of the different sections of the blog post or book chapter I am going to write before I sit down to write it.</p>\r\n\r\n<p>This very chapter started from an outline in which I decided what major points I was going to cover.</p>\r\n\r\n<p>This will give some structure to your posts. Plus, it&rsquo;s encouraging to know that you need to write about this topic, followed by that topic, then that topic and then you are done.</p>\r\n\r\n<p>You will also want to decide what kind of blog post you are going to write.</p>\r\n\r\n<p>Here are some of the common types of blog posts you could pick:</p>\r\n\r\n<ul>\r\n	<li>How-to post showing how to do something.</li>\r\n	<li>Opinion post where you are expressing your opinion about a technology, framework, programming language, etc.</li>\r\n	<li>Opinion post where you are talking about a general concept or methodology and why it is good or bad.</li>\r\n	<li>News or current event where you report about something that happened or is going on.</li>\r\n	<li>Review, where you review a product or service.</li>\r\n	<li>Expert roundup where you get opinions from different experts on a topic.</li>\r\n	<li>Technology or news roundup where you round up a bunch of news or other posts on a topic, or daily or weekly posts about some subject.</li>\r\n	<li>Interview, where you interview someone and write it out as a post.</li>\r\n	<li>Resource, where you create a resource or guide about some technology, framework or tool.</li>\r\n	<li>Explainer post where you explain a topic to your audience so that they can understand it better.</li>\r\n</ul>\r\n\r\n<p>And this list is by no means comprehensive.</p>\r\n\r\n<p><strong>There are hundreds of types of blog posts you could write.</strong></p>\r\n\r\n<p>Try to keep your posts on topic, though.</p>\r\n\r\n<p>When you are first starting out, no one wants to know about your personal life and what you did today.</p>\r\n\r\n<p>Once you build up an audience, some personal posts may interest them, but try to stay on topic as much as possible.</p>\r\n\r\n<p>The key thing is that you just do it.</p>\r\n\r\n<p>Give it your best shot.</p>\r\n\r\n<p>It doesn&rsquo;t have to be perfect.</p>\r\n\r\n<p>It doesn&rsquo;t have to be a work of art.</p>\r\n\r\n<p>Just write something and post it. Get &lsquo;er done!</p>\r\n\r\n<h2>The Power Of Consistency<img alt="" src="https://simpleprogrammer.com/wp-content/uploads/2017/07/Typing-1024x1024.png" style="height:351px; width:351px" /></h2>\r\n\r\n<p>If you want to be a successful blogger,&nbsp;<strong>the most important thing you can do is be consistent.</strong></p>\r\n\r\n<p>I don&rsquo;t know any successful bloggers who don&rsquo;t consistently produce content, but I know plenty of unsuccessful bloggers who very rarely update their blog and don&rsquo;t have a consistent posting schedule.</p>\r\n\r\n<p>Consistency is key.</p>\r\n\r\n<p>Pick some kind of schedule and stick to it.</p>\r\n\r\n<p>Don&rsquo;t make it optional.</p>\r\n\r\n<p>Don&rsquo;t blog only when you feel like it.</p>\r\n\r\n<p>Pretend you work for a newspaper which has a deadline that has to be met and you have to publish your post, ready or not.</p>\r\n\r\n<p>In fact, treat it like a real deadline and&nbsp;<strong>put in your calendar the exact time and date that each post is due to be published and the exact time and date you are going to write your posts.</strong></p>\r\n\r\n<p>If you know you have to have your blog post published at 10am every Monday and you&rsquo;ve set a specific time on your calendar each week to write the post, you are much more likely to be consistent.</p>\r\n\r\n<p><strong>In the long run,&nbsp;<a href="https://simpleprogrammer.com/cg53-heroics">consistency beats out every other factor.</a></strong></p>\r\n\r\n<p>Trust me, there are going to be days and weeks where you just don&rsquo;t feel like blogging at all.</p>\r\n\r\n<p>You are going to have times when you aren&rsquo;t seeing any results from your blogging and it is going to seem pointless and worthless.</p>\r\n\r\n<p>You have to keep going anyway.</p>\r\n\r\n<p>Discipline is doing what you are supposed to do whether you feel like it or not.</p>\r\n\r\n<p>And you need to have discipline to keep writing and to do it consistently.</p>\r\n\r\n<p>In time, results will come. Most people are not patient or consistent enough to wait for results, and that is why most people fail to get what they want out of life.</p>\r\n\r\n<p>Remember that.</p>\r\n\r\n<h2>Getting Traffic</h2>\r\n\r\n<p>It&rsquo;s not fun creating a blog that never gets read.</p>\r\n\r\n<p>When I first started my blog at Simple Programmer, I&rsquo;m pretty sure the three or four views I got each day were from my mom and perhaps a random coworker who was just curious what I was up to.</p>\r\n\r\n<p>But&nbsp;<strong>I kept writing</strong>&nbsp;and I kept posting blog posts and eventually traffic came.</p>\r\n\r\n<p>Were there some things I did to increase the traffic specifically?</p>\r\n\r\n<p>Sure, there were a few things, but overall the most important factors were consistency and time, and we&rsquo;ve already covered consistency.</p>\r\n\r\n<p><strong>Over the life of your blog, most of your traffic will likely come from search engines&mdash;</strong>to be more specific, from Google.</p>\r\n\r\n<p>It used to be possible to game the search engines and stuff a bunch of keywords into your web pages or create a bunch of dummy links to your site (backlinks), that would cause your page and site to rank higher in Google searches.</p>\r\n\r\n<p>Long gone are those days.</p>\r\n\r\n<p>Not to say that you can&rsquo;t do any kind of search engine optimization (SEO), but I wouldn&rsquo;t waste a huge amount of time on these efforts, at least not at first.</p>\r\n\r\n<p><strong>The key thing is to create good content that people will want to share and link to.</strong></p>\r\n\r\n<p>If you keep creating good content, not only will people share that content and link to it from their sites, but they&rsquo;ll bookmark your site and keep coming back for more.</p>\r\n\r\n<p>There is no shortcut here, though; it just takes time.</p>\r\n\r\n<p>The more blog posts you have out there and the more time they sit out there, the more likely it is going to be that you are going to have a least one post that goes &ldquo;viral&rdquo; and gets spread and shared quite a bit.</p>\r\n\r\n<p>These viral posts increase your overall traffic permanently, as they are a signal to search engines that your blog is an authority on a subject and has good content.</p>\r\n\r\n<p><strong>I&rsquo;d recommend writing a few &ldquo;epic&rdquo; posts on your blog&nbsp;</strong>that will be so good that people can&rsquo;t help but share them.</p>\r\n\r\n<p>Create a few ultimate guides or posts that you consider the best resource on whatever topic you are writing about.</p>\r\n\r\n<p>For example, I have an extremely popular post that I keep updated called &ldquo;<a href="https://simpleprogrammer.com/cg53-podcast">The Ultimate List of Developer Podcasts.</a>&rdquo;</p>\r\n\r\n<p>This one post gets me 150 to 300 new visitors each day.</p>\r\n\r\n<p>Plenty of people link to it, tweet about it and share it, because it is really the best resource out there for software development and programming podcasts.</p>\r\n\r\n<p>Another good strategy that is only effective when you are first starting out, is to&nbsp;<strong>comment on other people&rsquo;s software development blogs.</strong></p>\r\n\r\n<p>This strategy won&rsquo;t bring you a huge amount of traffic, but it can get you a few visitors a day and can start to get you some general exposure as people click on your profile or a link you provide and go back to your site.</p>\r\n\r\n<p>A popular blogger might even read one of your articles and like it enough to link to it on one of his posts, which would get you more traffic and a nice backlink.</p>\r\n\r\n<p>You have to be careful with this tactic though, because you don&rsquo;t want to just spam other people&rsquo;s blogs, otherwise you&rsquo;ll have the opposite effect and you&rsquo;ll likely just have your comments deleted anyway.</p>\r\n\r\n<p>Only add real, valuable comments which actually contribute to the post, and if you link back to your site, you&rsquo;d better have a really good reason to do so.</p>\r\n\r\n<p>You should, of course, share your posts on social media and do some basic SEO.</p>\r\n\r\n<p><img alt="" src="https://simpleprogrammer.com/wp-content/uploads/2017/07/SEo-1024x576.png" style="height:402px; width:714px" /></p>\r\n\r\n<p>If your blog is a WordPress blog, you can find SEO plugins like Yoast SEO which will do most of the SEO work for you.</p>\r\n\r\n<p><strong><em>|Hey John| Can you explain what SEO is?</em></strong></p>\r\n\r\n<p><em>Sure, SEO means search engine optimization, which basically means optimizing what you write so it&rsquo;s more likely to be suggested by results in search engines like Google.</em></p>\r\n\r\n<p><em>There is a whole industry based around SEO, because for most websites, the largest source of traffic they&rsquo;ll ever get is from Google searches. If you can optimize your content to rank highly for popular search terms, you&rsquo;ll&hellip; well, you&rsquo;ll have a lot of traffic.</em></p>\r\n\r\n<p><em>The only problem is, SEO is an arms race with Google.</em></p>\r\n\r\n<p><em>As people try and &ldquo;game&rdquo; SEO to trick Google into ranking their pages higher for certain search terms, Google is constantly tweaking their own algorithms to prevent people from manipulating the results.</em></p>\r\n\r\n<p><em>Google&rsquo;s goal is the have the most relevant and valuable content surface for each search term so that the data they provide is more valuable to the end user.</em></p>\r\n\r\n<p><em>So, yes there are some things you can do to explicitly try and &ldquo;trick&rdquo; Google and there are some valid things you can do to give Google hints about your content, but overall the best long-term strategy is going to be to write the kind of quality content that is naturally going to rise to the top of search results because it is truly valuable.</em></p>\r\n\r\n<p>Overall,&nbsp;<strong>what is going to matter most in getting traffic is writing high-quality posts, often, consistently, and&nbsp;<a href="http://rodrigochichierchio.com/optimize-old-content/">over a long period of time</a>.</strong></p>\r\n\r\n<h2>Finding Your Voice</h2>\r\n\r\n<p>One of the biggest mistakes I&rsquo;ve found with new bloggers and writers, in general, is that&nbsp;<strong>they try to present everything as if they were writing an academic paper or news report.</strong></p>\r\n\r\n<p>It&rsquo;s dry and bland and lacks any kind of character or spunk.</p>\r\n\r\n<p>It&rsquo;s ok to try and sound professional, but&nbsp;<strong>a writer without a unique and individual voice is just going to be boring as hell.</strong></p>\r\n\r\n<p>Think about this book.</p>\r\n\r\n<p>If you&rsquo;ve read this far, you&rsquo;ve no doubt been exposed to my voice in the writing.</p>\r\n\r\n<p>I&rsquo;m not just telling you facts&mdash;or opinions, in my case&mdash;<strong>I&rsquo;m presenting them in a unique way that is hopefully entertaining, but definitely is identifiable as my voice.</strong></p>\r\n\r\n<p>Now, I&rsquo;m no Hemingway or C.S. Lewis.</p>\r\n\r\n<p>I&rsquo;ve got plenty that I can improve in my writing, but for the most part, I&rsquo;ve found my voice.</p>\r\n\r\n<p>That&rsquo;s what you have to do&mdash;if you actually want people to read your stuff.</p>\r\n\r\n<p>Finding your voice isn&rsquo;t easy, though.</p>\r\n\r\n<p>You have to be willing to try things out and go to different extremes until you settle on what fits you best.</p>\r\n\r\n<p>And your voice will change at times, depending on your mood and what you are talking about.</p>\r\n\r\n<p>Some of the chapters I wrote in this book were much more &ldquo;spunky,&rdquo; others were a bit more on the dry side, but you should have gained some overarching kind of feel for who I am based on the way most of the chapters in this book were written.</p>\r\n\r\n<p><strong>Your voice in writing is who you are.</strong></p>\r\n\r\n<p>Someone reading your posts shouldn&rsquo;t just learn how to create an Android application using the latest Java framework, they should also get an idea of who you are as a writer and what your personality is.</p>\r\n\r\n<p>That&rsquo;s what makes writing interesting.</p>\r\n\r\n<p>As much as humans are interested in technology, they are much more interested in people.</p>\r\n\r\n<p>People magazine will always outsell MSDN magazine&mdash;I promise.</p>\r\n\r\n<p>So,&nbsp;<strong>don&rsquo;t be afraid to insert some personality into your writing.</strong></p>\r\n\r\n<p>Give it a little &ldquo;spunk.&rdquo;</p>\r\n\r\n<p>It&rsquo;s ok to have an opinion.</p>\r\n\r\n<p>It&rsquo;s even ok to have bad grammar&mdash;if it serves your purpose.</p>\r\n\r\n<p>Try a few different shoes and see which one fits.</p>\r\n\r\n<p>Try writing like you talk.</p>\r\n\r\n<p>Try writing in different styles and express yourself in different ways.</p>\r\n\r\n<p><strong>Try throwing the word &ldquo;fuck&rdquo; into your writing and see how that feels.</strong></p>\r\n\r\n<p>Shake things up.</p>\r\n\r\n<p>I find that one of the best ways to find your natural range is to&nbsp;<strong>go to one extreme and then the other, pushing the envelope in both directions.</strong></p>\r\n\r\n<p>You&rsquo;ll settle down where you feel most comfortable, which is usually somewhere in the middle, but with the capability to go to either extreme at any time.</p>\r\n\r\n<p>And remember, this is a process.</p>\r\n\r\n<p>I&rsquo;ve written millions of words and I&rsquo;m still going through this process myself.</p>\r\n\r\n<p>I&rsquo;ll always be searching for my voice&mdash;and you will, too.</p>\r\n\r\n<p>At first it will be difficult to find, but one day you&rsquo;ll write a post and you&rsquo;ll think &ldquo;Damn, that was fricken sweet,&rdquo; or &ldquo;Shucks, that was a golly swell post,&rdquo; or &ldquo;Hot dog, I rock!&rdquo; or &ldquo;I felt that conveyed my sentiments very precisely.&rdquo;</p>\r\n\r\n<p>Get it?</p>\r\n\r\n<p><strong><em>|Hey John| How do I deal with the &ldquo;trolls&rdquo; and &ldquo;haters&rdquo; who say negative things about my writing or post negative comments on my content?</em></strong></p>\r\n\r\n<p><em>Ah, yes the trolls.</em></p>\r\n\r\n<p><em>Those people who have such critical opinions of what you are doing, but don&rsquo;t seem to be producing anything themselves.</em></p>\r\n\r\n<p><em>There are plenty of ways to deal with trolls and haters, that range from ignoring them, to calling them out, to directly combating them with indisputable facts and figures, and even replying with your own absurdity to compliment theirs. (I&rsquo;ve done all of these things.)</em></p>\r\n\r\n<p><em>But for the most part, the most effective thing to do is to ignore them.</em></p>\r\n\r\n<p><em>No matter what you do&mdash;especially if it is of any value or consequence&ndash;you are going to have haters and people who want to disparage you and make you feel bad.</em></p>\r\n\r\n<p><em>Rather than being angry at these people and letting them discourage you in any way, you should feel sorry for them.</em></p>\r\n\r\n<p><em>One human being does not lash out and attempt to destroy the work of another human being unless that first human being is in some kind of great pain themselves.</em></p>\r\n\r\n<p><em>Most of the time when someone is attacking you or your work it is more about them than it is about you.</em></p>\r\n\r\n<p><em>Perhaps, what you&rsquo;ve said or even the very fact that you&rsquo;ve done something with your life and produced something threatens them in some way.</em></p>\r\n\r\n<p><em>Perhaps, they are just having a bad day&mdash;or a bad life&mdash;and they are just crying out for help in the only way they know how; like a child looking for any form of attention that the world will give them.</em></p>\r\n\r\n<p><em>Regardless, however you decide to handle the situation, don&rsquo;t let them take you down.</em></p>\r\n\r\n<p><em>Keep doing what you are doing, don&rsquo;t take it personal, stay calm, and carry on.</em></p>\r\n\r\n<h2>Keep Writing<img alt="" src="https://simpleprogrammer.com/wp-content/uploads/2017/07/Writing-Keyboard.png" style="height:350px; width:350px" /></h2>\r\n\r\n<p>I can only fit so much in this short chapter on blogging.</p>\r\n\r\n<p><a href="https://simpleprogrammer.com/cg53-blogging">I&rsquo;m sure I could fill an entire book on the subject.</a></p>\r\n\r\n<p>So, I tried to give you what I think are some of&nbsp;<strong>the most important ideas and concepts</strong>&nbsp;to get you started and keep you going.</p>\r\n\r\n<p>However, I want to leave you with one final piece of advice:&nbsp;<strong>keep writing.</strong></p>\r\n\r\n<p><a href="https://simpleprogrammer.com/cg53-writing">Writing is not easy.</a></p>\r\n\r\n<p>It&rsquo;s not always fun.</p>\r\n\r\n<p>Famous author, poet, and screenwriter Dorothy Parker, when asked if she enjoyed writing said, &ldquo;I enjoy having&nbsp;<em>written.</em>&rdquo;</p>\r\n\r\n<p>Despite how bad you might suck, how painful it feels and how much you think you just aren&rsquo;t a writer and no one will possibly read what you wrote,&nbsp;<strong>do it anyway and keep doing it.</strong></p>\r\n\r\n<p>In time, you will improve.</p>\r\n\r\n<p>You will get better.</p>\r\n\r\n<p>And if you keep at it long enough, the reward will come.</p>\r\n\r\n<p>In high school I was in every advanced placement class they offered, except for one: AP English.</p>\r\n\r\n<p>I did AP Calculus as a sophomore, I took AP U.S. History, AP Biology, AP Chemistry, AP European History, but I was not allowed into the AP English class.</p>\r\n\r\n<p>To put it bluntly,&nbsp;<strong>I sucked at writing.</strong></p>\r\n\r\n<p>Or rather, I sucked at writing the way people wanted me to write.</p>\r\n\r\n<p>But, here I am now, in many respects, writing for a living,&nbsp;<a href="https://simpleprogrammer.com/cg53-lifemanual">having published one extremely successful book</a>&nbsp;and pounding out another.</p>\r\n\r\n<p>My first blog post was horrible.</p>\r\n\r\n<p>The next few just as bad.</p>\r\n\r\n<p>But the one I wrote last week&hellip; well, it&rsquo;s halfway decent and it&rsquo;s getting better all the time.</p>\r\n\r\n<p>If I can do it, you can do it. All you have to do is keep writing.</p>', 1, '2024-03-11 23:43:16', '2024-03-11 23:43:16');

-- Dumping structure for table jobpulse.candidates
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hsc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hons` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_qualification` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `candidates_user_id_foreign` (`user_id`),
  CONSTRAINT `candidates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.candidates: ~0 rows (approximately)
INSERT INTO `candidates` (`id`, `image`, `user_id`, `address`, `ssc`, `hsc`, `hons`, `other_qualification`, `created_at`, `updated_at`) VALUES
	(1, '', 2, '109,cha, Barontake, Dhaka-cant, Dhaka-1206', '<p><strong>School:&nbsp;</strong>BAF Shaheen College, Kurmitola</p>\r\n\r\n<p><strong>GPA : </strong>5.00 out of 5.00</p>\r\n\r\n<p><strong>Department:&nbsp;</strong>Commerce<br />\r\n<strong>Board</strong>: Dhaka&nbsp;</p>\r\n\r\n<p><strong>Session</strong>: 2009-2011</p>', '<p><strong>College:&nbsp;</strong>BAF Shaheen College, Kurmitola</p>\r\n\r\n<p><strong>GPA : </strong>5.00 out of 5.00</p>\r\n\r\n<p><strong>Department:&nbsp;</strong>Commerce<br />\r\n<strong>Board</strong>: Dhaka&nbsp;</p>\r\n\r\n<p><strong>Session</strong>: 2011-2013</p>', '<p><strong>University :&nbsp;</strong>Southeast University</p>\r\n\r\n<p><strong>CGPA :&nbsp;</strong>3.69 out of 4.00</p>\r\n\r\n<p><strong>Department:&nbsp;</strong>Finance<br />\r\n<strong>Location</strong>: Dhaka&nbsp;</p>\r\n\r\n<p><strong>Session</strong>: 2013-2019</p>', '<table cellspacing="0">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Work experience</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Medigene IT</strong></p>\r\n			</td>\r\n			<td>\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td>\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td>\r\n			<p><strong>May 2020 &mdash; Present</strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Web Developer</p>\r\n\r\n<p>Spearheaded the end-to-end development and maintenance of 4 complex web applications using the Laravel framework, resulting in 20% faster page load times and accommodating a 300% increase in user traffic while maintaining optimal performance and scalability.</p>\r\n\r\n<p>Collaborated closely with cross-functional teams, including designers, product managers, and QA engineers, to deliver 5 successful web projects that consistently exceeded clients&#39; unique requirements, leading to a 95% client satisfaction rate and securing $2 million in contract renewals. Leveraged advanced database optimization techniques, reducing query execution time by 40% and slashing server response time, thus enhancing overall application efficiency and providing a seamless user experience even during peak loads.</p>\r\n\r\n<p>Took a pivotal role in front-end development using Vue.js, resulting in an improved user engagement with 25% longer average session durations, increased page interactions, and a 15% decrease in bounce rates across applications.</p>\r\n\r\n<p>Conducted thorough code reviews, debugging, and troubleshooting, leading to a 45% reduction in post-release defects and contributing to 90% application uptime over the course of a year, ensuring exceptional code quality and application reliability.</p>\r\n\r\n<p>Successfully integrated 4 third-party APIs, expanding the functionality and scope of web applications, which led to a 30% reduction in development time for implementing new features and enabling innovative capabilities such as real-time chat and social media sharing.</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Intelligent Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; April 2019 &mdash; October 2019</strong></p>\r\n\r\n<p><strong>Management Limited (IIML)</strong></p>\r\n\r\n<p>Data Entry Specialist</p>\r\n\r\n<p>Demonstrated precision and efficiency in processing over 10,000 data entries within tight deadlines, maintaining impeccable standards of data accuracy and integrity, which contributed to a 98% reduction in data errors and enhanced the reliability of critical business reports.</p>\r\n\r\n<p>Collaborated seamlessly with a cross-functional team of 8 members to categorize and manage a database of 50,000 records from image, resulting</p>\r\n\r\n<p>in 20% faster data retrieval times and contributing to streamlined operations that allowed team members to access relevant information swiftly. Assisted in the formulation of data management protocols that improved data handling workflows, resulting in a 30% increase in data processing efficiency and reducing data redundancy by implementing effective deduplication strategies.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Qualifications&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>Relevant Projects:</p>\r\n\r\n<p>Completed several comprehensive web development projects using Laravel and Vue.js, demonstrating practical application of skills acquired during coursework and certifications.</p>\r\n\r\n<p>This section allows you to showcase your educational background, formal certifications, as well as any additional courses, workshops, or projects that reinforce your expertise in web development. Make sure to adapt this section to include the actual names of the institutions, platforms, issuers, and organizers, along with the corresponding years of completion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Skills</strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>HTML</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>CSS</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Javascript</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>JQUERY</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>AJAX</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>PHP</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>MYSQL</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Vue,js</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>TailwindCss</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>&nbsp;Bootstrap</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Git</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Teamwork</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Soft Skills&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></p>\r\n\r\n<p>Effective Communication: Clear and concise communicator, adept at</p>\r\n\r\n<p>explaining complex technical concepts to both technical and non-technical stakeholders.</p>\r\n\r\n<p>Problem Solving: Strong analytical thinker with a knack for dissecting intricate problems and devising innovative solutions.</p>\r\n\r\n<p>Collaborative Team Player: Proven ability to collaborate seamlessly within cross-functional teams, contributing positively to group dynamics and project outcomes.</p>\r\n\r\n<p>Adaptability: Quick learner with the ability to swiftly adapt to new technologies, languages, and frameworks as the industry evolves.</p>\r\n\r\n<p>Attention to Detail: Meticulous and thorough in reviewing code, data, and project requirements, ensuring accuracy and high-quality deliverables.</p>\r\n\r\n<p>Time Management: Skillful at prioritizing tasks and managing deadlines effectively, maintaining productivity in fast-paced environments.</p>\r\n\r\n<p>Creativity: Innovative thinker, capable of bringing fresh and creative ideas to design and development projects.</p>', '2024-03-12 04:24:20', '2024-03-12 04:42:47');

-- Dumping structure for table jobpulse.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `categories_user_id_foreign` (`user_id`),
  CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.categories: ~0 rows (approximately)

-- Dumping structure for table jobpulse.contact_settings
CREATE TABLE IF NOT EXISTS `contact_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_us` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.contact_settings: ~0 rows (approximately)

-- Dumping structure for table jobpulse.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `employees_user_id_foreign` (`user_id`),
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.employees: ~0 rows (approximately)
INSERT INTO `employees` (`id`, `name`, `email`, `mobile`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Employee 1', 'employee@em.com', '01721206852', 1, '2024-03-07 01:53:13', '2024-03-07 02:00:35');

-- Dumping structure for table jobpulse.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` float(10,2) DEFAULT NULL,
  `requirements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `specialities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deadline` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `experience` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `responsibilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `compensations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_status` enum('Full Time','Part time') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_user_id_foreign` (`user_id`),
  CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.jobs: ~2 rows (approximately)
INSERT INTO `jobs` (`id`, `type`, `salary`, `requirements`, `user_id`, `specialities`, `deadline`, `created_at`, `updated_at`, `experience`, `responsibilities`, `compensations`, `location`, `employee_status`) VALUES
	(1, 'Frontend', 500.00, '', 1, 'js,jquery , vue,laravel', '2024-03-31', '2024-03-07 03:55:31', '2024-03-07 04:10:23', NULL, '', '', '', 'Full Time'),
	(2, 'Backend', 500.00, '', 12, 'php, js , node, laravel', '2024-04-30', '2024-03-07 04:18:15', '2024-03-07 04:18:15', NULL, '', '', '', 'Full Time'),
	(3, 'Full Stack', 50000.00, '<p>Education</p>\n\n<ul>\n	<li>Bachelor/Honors</li>\n</ul>\n\n<p>Additional Requirements</p>\n\n<ul>\n	<li>Age 20 to 30 years</li>\n</ul>', 12, 'js.,php,laravel', '2024-03-30', '2024-03-10 22:14:17', '2024-03-11 05:16:16', '<p>Experience</p>\n\n<ul>\n	<li>2 to 3 years</li>\n	<li>The applicants should have experience in the following business area(s):<br />\n	Software Company, Direct Selling/Marketing Service Company</li>\n	<li>Freshers are also encouraged to apply.</li>\n</ul>', '<p>Responsibilities &amp; Context</p>\n\n<p>We&#39;re seeking talented individuals to join our growing team! We have exciting opportunities for WordPress, Next.js developers, and sales representatives.</p>\n\n<p><strong>WordPress Developers:</strong></p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>\n	<p>Do you have a passion for building dynamic websites with WordPress?</p>\n	</li>\n	<li>\n	<p>We&rsquo;re looking for developers with 2+ years of experience in both WordPress frontend and backend development.</p>\n	</li>\n	<li>\n	<p>Strong database knowledge and experience integrating WordPress with other CMS platforms is a plus.</p>\n	</li>\n	<li>\n	<p>WooCommerce expertise and familiarity with ERP, CRM, HRM, and SRM systems are highly desirable.</p>\n	</li>\n	<li>\n	<p>Bonus points for excellent PHP skills!</p>\n	</li>\n</ul>\n\n<p><strong>Next.js Developers:</strong></p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>\n	<p>Are you a React and Next.js pro with a knack for building modern user interfaces?</p>\n	</li>\n	<li>\n	<p>We need developers with a strong understanding of frontend and backend development using React with Next.js.</p>\n	</li>\n	<li>\n	<p>Experience with Prisma ORM, Tailwind CSS, and Framer Motion will take your application to the top.</p>\n	</li>\n</ul>\n\n<p>&nbsp;</p>\n\n<p><strong>Sales Representatives:</strong></p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>\n	<p>Do you thrive in a fast-paced environment and enjoy exceeding expectations?</p>\n	</li>\n	<li>\n	<p>We&rsquo;re looking for charismatic and articulate sales representative to represent our brand.</p>\n	</li>\n	<li>\n	<p>Fluent communication in both English and Bangla is a must-have.</p>\n	</li>\n	<li>\n	<p>You possess excellent sales skills, a proven track record of achieving targets, and a dedication to teamwork.</p>\n	</li>\n</ul>', '<p><br />\nWe&rsquo;re Forward-Thinking Software Development Company<br />\n<br />\nAt ZettaByte, we&rsquo;re passionate about building innovative software solutions in a collaborative and supportive environment. We believe that the key to exceptional customer service lies in empowering our talented team members.</p>\n\n<p><strong>Here&rsquo;s what sets us apart:</strong></p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>\n	<p>Employee-Centric Culture: We invest in our employees&rsquo; well-being and professional growth, fostering a culture of excellence and dedication.</p>\n	</li>\n	<li>\n	<p>Competitive Compensation &amp; Benefits: We offer a comprehensive package that includes competitive salaries, flexible work arrangements (5 days/week), paid holidays with bonuses, a robust medical benefits plan, and a safe and secure work environment.</p>\n	</li>\n	<li>\n	<p>Prime Location &amp; Career Growth: Our prominent office location is easily accessible, and we provide exciting opportunities for career advancement within a dynamic industry.</p>\n	</li>\n</ul>', 'Dhaka', 'Full Time');

-- Dumping structure for table jobpulse.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2023_07_11_152531_create_users', 1),
	(3, '2023_07_23_133551_create_categories', 1),
	(4, '2024_02_27_110032_create_permission_tables', 1),
	(5, '2024_03_01_135815_create_employees_table', 1),
	(6, '2024_03_01_135822_create_jobs_table', 1),
	(7, '2024_03_01_140625_create_about_settings_table', 1),
	(8, '2024_03_01_140659_create_blogs_table', 1),
	(9, '2024_03_01_140757_create_candidates_table', 1),
	(10, '2024_03_01_141154_create_contact_settings_table', 1),
	(11, '2024_03_01_141419_create_plugins_table', 1),
	(12, '2024_03_11_033430_add_columns_to_jobs_table', 2),
	(14, '2024_03_12_114632_create_apply_jobs_table', 3);

-- Dumping structure for table jobpulse.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table jobpulse.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.model_has_roles: ~2 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(3, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 12);

-- Dumping structure for table jobpulse.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.permissions: ~44 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(2, 'Admin Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(3, 'Admin Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(4, 'Admin Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(5, 'Roles List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(6, 'Roles Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(7, 'Roles Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(8, 'Roles Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(9, 'Company List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(10, 'Company Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(11, 'Company Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(12, 'Company Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(13, 'Job List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(14, 'Job Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(15, 'Job Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(16, 'Job Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(17, 'Employee List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(18, 'Employee Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(19, 'Employee Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(20, 'Employee Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(21, 'Blog List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(22, 'Blog Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(23, 'Blog Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(24, 'Blog Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(25, 'Category List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(26, 'Category Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(27, 'Category Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(28, 'Category Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(29, 'Post List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(30, 'Post Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(31, 'Post Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(32, 'Post Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(33, 'Pages List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(34, 'Pages Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(35, 'Pages Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(36, 'Pages Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(37, 'Plugin List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(38, 'Plugin Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(39, 'Plugin Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(40, 'Plugin Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(41, 'Profile List', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(42, 'Profile Create', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(43, 'Profile Edit', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41'),
	(44, 'Profile Show', 'web', '2024-03-05 05:14:41', '2024-03-05 05:14:41');

-- Dumping structure for table jobpulse.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.personal_access_tokens: ~0 rows (approximately)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(56, 'App\\Models\\User', 2, 'authToken', 'dd4c3d33bfbb62b73ed108298b8e878a69473b3e34998f47676ff8d91d5a32f9', '["Candidate"]', '2024-03-12 05:54:04', NULL, '2024-03-12 05:30:09', '2024-03-12 05:54:04');

-- Dumping structure for table jobpulse.plugins
CREATE TABLE IF NOT EXISTS `plugins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.plugins: ~0 rows (approximately)

-- Dumping structure for table jobpulse.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Owner', 'web', '2024-03-05 05:14:33', '2024-03-05 05:14:33'),
	(2, 'Company', 'web', '2024-03-05 05:14:33', '2024-03-05 05:14:33'),
	(3, 'Candidate', 'web', '2024-03-05 05:14:33', '2024-03-05 05:14:33');

-- Dumping structure for table jobpulse.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.role_has_permissions: ~48 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(1, 3),
	(2, 3),
	(3, 3),
	(4, 3);

-- Dumping structure for table jobpulse.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Owner','Company','Candidate') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Candidate',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jobpulse.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `mobile`, `password`, `otp`, `type`, `created_at`, `updated_at`) VALUES
	(1, 'YO YO', 'Ibrahim Himu', 'shahnewaz886@gmail.com', '01521480800', '$2y$10$Ve1Q0kvoDrV.WIENS.bb4evoaO6WZ7F0UosRDnREnPAJbwDotvKai', '0', 'Owner', '2024-03-04 04:03:02', '2024-03-10 05:21:36'),
	(2, 'Shahnewaz', 'Himu', 'shahnewaz@gmail.com', '01873441702', '$2y$10$4cUQYl9SdbT32BubLflu9eFxt3X6AEIK59QNqLc1WLqA3UkPjJSC6', '0', 'Candidate', '2024-03-05 05:23:46', '2024-03-06 21:26:51'),
	(12, 'Himu', 'Ibrahim', 'himu88_6@hotmail.com', '01521480880', '$2y$10$5Dsm/w95Rsyz1oxcRH1onuZT3ytNYqQ6mN6dYL2T323GdWxzFyCMy', '0', 'Company', '2024-03-06 23:11:30', '2024-03-06 23:11:30');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
