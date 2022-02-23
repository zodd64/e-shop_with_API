package com.staxrt.tutorial.repository;

import com.staxrt.tutorial.model.Order;
import com.staxrt.tutorial.model.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

/**
 * The interface Product repository.
 *
 * @author 4402
 */
@Repository
public interface OrderRepository extends JpaRepository<Order, Long> {
}
