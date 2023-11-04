-- Active: 1699068758089@@127.0.0.1@3306@php_practice
select c.id, c.name, count(o.id) as total_order from customers c
join orders o on c.id = o.customer_id
GROUP BY o.customer_id
ORDER BY total_order DESC